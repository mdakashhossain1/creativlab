const testimonialSwiper = document.querySelector(".testimonial-swiper");
if (testimonialSwiper) {
    var swiper = new Swiper(testimonialSwiper, {
        effect: "fade",
        autoplay: {
            delay: 2500,
            disableOnInteraction: false,
        },
        pagination: {
            el: ".swiper-pagination",
            clickable: true,
        },
        navigation: {
            nextEl: ".swiper-button-next",
            prevEl: ".swiper-button-prev",
        },
    });
}

if (
    document.querySelector(".product-showcase-3-4" && ".product-showcase-3-5")
) {
    new Swiper(".product-showcase-3-4", {
        loop: true,
        spaceBetween: 20,
        slidesPerView: 5,
        freeMode: true,
        watchSlidesProgress: true,
        breakpoints: {
            320: {
                slidesPerView: 2,
                spaceBetween: 20,
            },
            768: {
                slidesPerView: 5,
            },
        },
    });
    new Swiper(".product-showcase-3-5", {
        loop: true,
        effect: "fade",
        spaceBetween: 10,

        thumbs: {
            swiper: ".product-showcase-3-4",
        },
    });
}
if (document.querySelector(".product-swiper")) {
    new Swiper(".product-swiper", {
        spaceBetween: 30,
        slidesPerView: 4,
        loop: true,

        breakpoints: {
            320: {
                slidesPerView: 1,
            },
            768: {
                slidesPerView: 2,
            },
            1024: {
                slidesPerView: 3,
            },
            1200: {
                slidesPerView: 4,
            },
        },

        navigation: {
            nextEl: ".pd-btn-next",
            prevEl: ".pd-btn-prev",
        },
    });
}



if (document.getElementsByClassName("h1-partner_slider")) {
    new Swiper(".h1-partner_slider", {
        slidesPerView: 3,
        spaceBetween: 30,
        loop: true,
        autoplay: {
            delay: 2500,
            disableOnInteraction: false,
        },
        pagination: false,
        navigation: false,
        breakpoints: {
            640: {
                slidesPerView: 4,
                spaceBetween: 20,
            },
            768: {
                slidesPerView: 5,
                spaceBetween: 40,
            },
            1024: {
                slidesPerView: 6,
                spaceBetween: 50,
            },
        },
    });
}



const serviceFaqs = document.querySelectorAll(".service-faq-toggler");
const detafultHeight = 40;
window.addEventListener("load", (event) => {
    serviceFaqs.forEach((item, index) => {
        // Hide all FAQ bodies except the first one
        if (index !== 0 && item.children[1]) {
            item.children[1].style.display = "none";
        }
    });
});

if (serviceFaqs) {
    serviceFaqs.forEach((item) => {
        item.addEventListener("click", (e) => {
            serviceFaqs.forEach((faq) => {
                if (
                    e.target.getAttribute("name") === faq.getAttribute("name")
                ) {
                    // Show the FAQ body for the clicked item
                    if (item.children[1]) {
                        item.children[1].style.display = "block";
                    }
                    item.classList.add("bg-main-gray");
                } else {
                    // Hide FAQ bodies for all other items
                    if (faq.children[1]) {
                        faq.children[1].style.display = "none";
                    }
                    faq.classList.remove("bg-white");
                }
            });
        });
    });
}







if (document.getElementsByClassName("h1-story-slider-v2")) {
    new Swiper(".h1-story-slider-v2", {
        slidesPerView: 1,
        centeredSlides: true,
        spaceBetween: 30,
        loop: true,
        speed: 4000,
        autoplay: {
            delay: 2500,
        },
        pagination: {
            el: ".h1-story-pagination-v2",
            clickable: true,
        },
        navigation: {
            nextEl: ".h1-story-next-v2",
            prevEl: ".h1-story-prev-v2",
        },
        breakpoints: {
            640: {
                slidesPerView: 2,
                spaceBetween: 20,
            },
            1024: {
                slidesPerView: 2,
                spaceBetween: 50,
            },
            1200: {
                slidesPerView: 3,
                spaceBetween: 50,
            },
        },
    });
}



if (document.getElementsByClassName("h5-client_slider")) {
    new Swiper(".h5-client_slider", {
        slidesPerView: 3,
        spaceBetween: 30,
        loop: true,
        autoplay: {
            delay: 2500,
            disableOnInteraction: false,
        },
        pagination: false,
        navigation: false,
        breakpoints: {
            640: {
                slidesPerView: 4,
                spaceBetween: 20,
            },
            768: {
                slidesPerView: 5,
                spaceBetween: 40,
            },
            1024: {
                slidesPerView: 6,
                spaceBetween: 50,
            },
        },
    });
}


const navBtn = document.querySelectorAll(".toggle_nav_menu");
if (navBtn) {
    navBtn.forEach((element) => {
        element.addEventListener("click", (event) => {
            document
                .getElementById("mobile-nav-div")
                .classList.toggle("active_mobile_nav");
            document
                .getElementById("mobile-nav-div-overlay")
                .classList.toggle("active_mobile_nav");

            event.target.children[0].classList.toggle("hidden");
            event.target.children[1].classList.toggle("hidden");
        });
    });
    if (document.getElementById("mobile-nav-div-overlay")) {
        document
            .getElementById("mobile-nav-div-overlay")
            .addEventListener("click", () => {
                document
                    .getElementById("mobile-nav-div")
                    .classList.remove("active_mobile_nav");
                document
                    .getElementById("mobile-nav-div-overlay")
                    .classList.remove("active_mobile_nav");
                document
                    .getElementById("mobile_nav_toggle_menu")
                    .children[0].classList.remove("hidden");
                document
                    .getElementById("mobile_nav_toggle_menu")
                    .children[1].classList.add("hidden");
            });
    }
}

window.addEventListener("hashchange", (event) => {
    document
        .getElementById("mobile-nav-div")
        .classList.toggle("active_mobile_nav");
    document
        .getElementById("mobile-nav-div-overlay")
        .classList.toggle("active_mobile_nav");

    document
        .getElementById("mobile_nav_toggle_menu")
        .children[0].classList.toggle("hidden");
    document
        .getElementById("mobile_nav_toggle_menu")
        .children[1].classList.toggle("hidden");
});

let running = [];

const scrollAnimate = (event) => {
    const allData = document.querySelectorAll("[data-scroll-qs='scroll']");
    if (allData) {
        allData.forEach((item) => {
            const rect = item.getBoundingClientRect()?.y;
            if (rect - window.innerHeight <= 0 && rect >= 0) {
                if (running.indexOf(item) < 0) {
                    if (item.getAttribute("data-count-qs")) {
                        let countdown = null;
                        const count = Number(
                            item.getAttribute("data-count-qs")
                        );
                        const valueType = item.getAttribute("data-type-qs");
                        const speed = Number(
                            item.getAttribute("data-speed-qs")
                        );
                        let startNumber = 0;
                        clearInterval(countdown);
                        countdown = setInterval(function () {
                            item.innerText = startNumber + valueType;
                            startNumber++;
                            if (startNumber > count) {
                                clearInterval(countdown);
                            }
                        }, speed / count);
                    }
                    running.push(item);
                }
            } else {
                running = running.filter((value) => value != item);
            }
        });
    }
};

window.addEventListener("load", (event) => {
    scrollAnimate(event);
});

window.addEventListener("scroll", (event) => {
    scrollAnimate(event);
});

// parallax

function mouseMoveParallax(selectorId) {
    let scene = document.getElementById(`${selectorId}`);
    if (scene) {
        let parallaxInstance = new Parallax(scene);
    }
}

mouseMoveParallax("hero-mouse-move-anim");
mouseMoveParallax("home-working-cursor-anim");
mouseMoveParallax("consaltaion-mouse-move-anim");
mouseMoveParallax("home-one-about-mouse-anim");
mouseMoveParallax("about-shape-mouse-anim");


