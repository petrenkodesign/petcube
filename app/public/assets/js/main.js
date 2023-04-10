window.onload = (event) => {
    const second_slide_video = document.getElementById('second-slide-video');
    const first_slide_video = document.getElementById('first-slide-video');

    const ss_video_height = second_slide_video.offsetHeight;
    const fs_video_height = first_slide_video.offsetHeight;

    const window_height = window.innerHeight;

    const svideo_margin = ((window_height-ss_video_height)/2);
    const fvideo_margin = ((window_height-fs_video_height)/2);

    var slide = 1;

    // video play on scroll
    window.addEventListener("scroll", function() {

        const ssvideo_top = second_slide_video.getBoundingClientRect().top;
        const ssvideo_bottom = second_slide_video.getBoundingClientRect().bottom;
    
        const fsvideo_top = first_slide_video.getBoundingClientRect().top;
        const fsvideo_bottom = first_slide_video.getBoundingClientRect().bottom;
    
       
        if (ssvideo_top-(ss_video_height+svideo_margin) < 0 && ssvideo_bottom-svideo_margin > 0) {
            second_slide_video.play();
        } else {
            second_slide_video.pause();
        }
    
        if (fsvideo_top-(fs_video_height+fvideo_margin)  < 0 && fsvideo_bottom-fvideo_margin > 0) {
            first_slide_video.play();
        } else {
            first_slide_video.pause();
        }
    });

    // hero image slider 5s
    setInterval(function() {
        const hero_image = document.getElementsByClassName('hero-image-shell')[0];
        hero_image.style.backgroundImage = "url('/assets/img/dummy-app-mobile-"+slide+".png')";
        slide = (slide > 2) ? 1 : slide+1;
    }, 5000);

}

function preload_image(im_url) {
    const img = new Image();
    img.src = im_url;
}

preload_image('/assets/img/dummy-app-mobile-1.png');
preload_image('/assets/img/dummy-app-mobile-2.png');
preload_image('/assets/img/dummy-app-mobile-3.png');