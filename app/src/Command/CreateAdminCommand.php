<?php

namespace App\Command;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;


class CreateAdminCommand extends Command
{
    protected static $defaultName = 'app:create-admin';
    protected static $defaultDescription = 'Addes a new admin user to the dashboard';

    private $passwordEncoder;
    private $em;

    public function __construct(UserPasswordEncoderInterface $passwordEncoder, EntityManagerInterface $em)
    {
        parent::__construct();
        $this->passwordEncoder = $passwordEncoder;
        $this->em = $em;
    }

    protected function configure(): void
    {
        $this
            ->setName(self::$defaultName)
            ->setDescription(self::$defaultDescription)
            // ->addArgument('arg', InputArgument::OPTIONAL, 'Argument description')
            ->addOption('username', null, InputOption::VALUE_REQUIRED, 'Admin username')
            ->addOption('email', null, InputOption::VALUE_REQUIRED, 'Admin email')
            ->addOption('password', null, InputOption::VALUE_REQUIRED, 'Admin password')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        // $arg = $input->getArgument('arg');
        $username = $input->getOption('username');
        $email = $input->getOption('email');
        $password = $input->getOption('password');
        
        if ($username) {
            $io->note(sprintf('Admin got username: %s', $username));
        } else {
            $io->error('You must pass a username');
            return 1;
        }

        if ($email) {
            $io->note(sprintf('Admin got email: %s', $email));
        } else {
            $io->error('You must pass a email');
            return 1;
        }

        if ($password) {
            $io->note(sprintf('Admin got password: %s', $password));
        } else {
            $io->error('You must pass a password');
            return 1;
        }

        $user = new User();
        $user->setEmail($email);
        $user->setName($username);
        $user->setPassword($this->passwordEncoder->encodePassword($user, $password));
        $user->setRoles(['ROLE_ADMIN']);
        $user->setApproved(true);
        
        $this->em->persist($user);
        $this->em->flush();

        $io->success('Done! You have admin user, go to /profile now. Pass --help to see your options.');

        return 0;
    }
}
