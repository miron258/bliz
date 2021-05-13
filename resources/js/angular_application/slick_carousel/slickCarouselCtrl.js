ngApp.controller('SlickCarouselCtrl', ['$scope', '$http', function ($scope, $http) {
    'use strict';
    let API_URL = '/api/v1/';
//====================================
    // Slick Carousel Block Price
    //====================================
    $scope.slickConfigPrice = {
        method: {},
        dots: false,
        infinite: true,
        speed: 300,
        // appendDots: '.nav-dots',
        // appendArrows: '.nav-arrows',
        // nextArrow: '<button type="button" class="slick-arrow slick-carousel-control-next"></button>',
        // prevArrow: '<button type="button" class="slick-arrow slick-carousel-control-prev"></button>',
        slidesToShow: 2,
        centerPadding: '70px', //default 50px
        slidesToScroll: 1,
        rows: 0,
        responsive: [
            {
                breakpoint: 1024,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 1,
                    infinite: true,
                    dots: false
                }
            },
            {
                breakpoint: 600,
                settings: {
                    arrows: true,
                    nextArrow: '<button type="button" class="slick-arrow slick-carousel-control-next"></button>',
                    prevArrow: '<button type="button" class="slick-arrow slick-carousel-control-prev"></button>',
                    slidesToShow: 1,
                    slidesToScroll: 1,
                    dots: false
                }
            },
            {
                breakpoint: 480,
                settings: {
                    arrows: true,
                    nextArrow: '<button type="button" class="slick-arrow slick-carousel-control-next"></button>',
                    prevArrow: '<button type="button" class="slick-arrow slick-carousel-control-prev"></button>',
                    slidesToShow: 1,
                    slidesToScroll: 1,
                    dots: false
                }
            }
        ]
    };


    //====================================
    // End Slick Carousel Block Price
    //====================================





    //====================================
    // Slick Carousel Config Block Services
    //====================================
    $scope.slickConfigServices = {
        method: {},
        dots: false,
        infinite: false,
        arrows: false,
        speed: 300,
        // appendDots: '.nav-dots',
        // appendArrows: '.nav-arrows',
        // nextArrow: '<button type="button" class="slick-arrow slick-carousel-control-next"></button>',
        // prevArrow: '<button type="button" class="slick-arrow slick-carousel-control-prev"></button>',
        slidesToShow: 3,
        centerPadding: '50px', //default 50px
        slidesToScroll: 3,
        slidesPerRow: 3,
        rows: 2,
        // mobileFirst: true,
        responsive: [
            {
                breakpoint: 1024,
                settings: {
                    arrows: true,
                    // appendArrows: '.nav-arrows',
                    nextArrow: '<button type="button" class="slick-arrow slick-carousel-control-next"></button>',
                    prevArrow: '<button type="button" class="slick-arrow slick-carousel-control-prev"></button>',
                    slidesToShow: 3,
                    // slidesPerRow: 0,
                    rows: 0,
                    slidesToScroll: 3,
                    infinite: false,
                    dots: false
                }
            },
            {
                breakpoint: 600,
                settings: {
                    arrows: true,
                    // appendArrows: '.nav-arrows',
                    nextArrow: '<button type="button" class="slick-arrow slick-carousel-control-next"></button>',
                    prevArrow: '<button type="button" class="slick-arrow slick-carousel-control-prev"></button>',
                    slidesToShow: 1,
                    // slidesPerRow: 0,
                    rows: 0,
                    infinite: false,
                    slidesToScroll: 1,
                    dots: false
                }
            },
            {
                breakpoint: 480,
                settings: {
                    arrows: true,
                    // appendArrows: '.nav-arrows',
                    nextArrow: '<button type="button" class="slick-arrow slick-carousel-control-next"></button>',
                    prevArrow: '<button type="button" class="slick-arrow slick-carousel-control-prev"></button>',
                    rows: 0,
                    slidesToShow: 1,
                    slidesToScroll: 1,
                    dots: false
                }
            }
        ]
    };


    //====================================
    // End Slick Carousel Config Block Services
    //====================================


    //====================================
    // Slick Carousel Casing Options
    //====================================
    $scope.slickConfigCasingOptions = {
        method: {},
        dots: false,
        infinite: true,
        speed: 300,
        arrows: false,
        slidesToShow: 4,
        centerPadding: '50px', //default 50px
        slidesToScroll: 1,
        rows: 0,
        responsive: [
            {
                breakpoint: 1024,
                settings: {
                    arrows: true,
                    nextArrow: '<button type="button" class="slick-arrow slick-carousel-control-next"></button>',
                    prevArrow: '<button type="button" class="slick-arrow slick-carousel-control-prev"></button>',
                    slidesToShow: 3,
                    slidesToScroll: 1,
                    infinite: false,
                    dots: false
                }
            },
            {
                breakpoint: 600,
                settings: {
                    arrows: true,
                    infinite: false,
                    nextArrow: '<button type="button" class="slick-arrow slick-carousel-control-next"></button>',
                    prevArrow: '<button type="button" class="slick-arrow slick-carousel-control-prev"></button>',
                    slidesToShow: 1,
                    slidesToScroll: 1,
                    dots: false
                }
            },
            {
                breakpoint: 480,
                settings: {
                    arrows: true,
                    nextArrow: '<button type="button" class="slick-arrow slick-carousel-control-next"></button>',
                    prevArrow: '<button type="button" class="slick-arrow slick-carousel-control-prev"></button>',
                    slidesToShow: 1,
                    slidesToScroll: 1,
                    dots: false
                }
            }
        ]
    };
//====================================
    // End Slick Carousel Casing Options
    //====================================


    //====================================
    // Slick Carousel Work Gallery
    //====================================
    $scope.slickConfigWorkGallery = {
        method: {},
        dots: true,
        arrows: false,
        infinite: false,
        speed: 300,
        appendDots: '.nav-dots',
        // appendArrows: '.nav-arrows',
        // nextArrow: '<button type="button" class="slick-arrow slick-carousel-control-next"></button>',
        // prevArrow: '<button type="button" class="slick-arrow slick-carousel-control-prev"></button>',
        slidesToShow: 1,
        centerPadding: '50px', //default 50px
        slidesToScroll: 1,
        rows: 0,
        responsive: [
            {
                breakpoint: 1024,
                settings: {
                    appendArrows: '.nav-arrows',
                    nextArrow: '<button type="button" class="slick-arrow slick-carousel-control-next"></button>',
                    prevArrow: '<button type="button" class="slick-arrow slick-carousel-control-prev"></button>',
                    slidesToShow: 1,
                    slidesToScroll: 1,
                    infinite: false,
                    arrows: true,
                    dots: true
                }
            },
            {
                breakpoint: 600,
                settings: {
                    appendArrows: '.nav-arrows',
                    nextArrow: '<button type="button" class="slick-arrow slick-carousel-control-next"></button>',
                    prevArrow: '<button type="button" class="slick-arrow slick-carousel-control-prev"></button>',
                    slidesToShow: 1,
                    slidesToScroll: 1,
                    infinite: false,
                    arrows: true,
                    dots: true
                }
            },
            {
                breakpoint: 480,
                settings: {
                    appendArrows: '.nav-arrows',
                    nextArrow: '<button type="button" class="slick-arrow slick-carousel-control-next"></button>',
                    prevArrow: '<button type="button" class="slick-arrow slick-carousel-control-prev"></button>',
                    slidesToShow: 1,
                    slidesToScroll: 1,
                    arrows: true,
                    dots: true
                }
            }
        ]
    };
    $scope.slickConfigWorkGallery2 = {
        method: {},
        arrows: false,
        dots: true,
        infinite: true,
        speed: 300,
        appendDots: '.nav-dots2',
        // appendArrows: '.nav-arrows',
        // nextArrow: '<button type="button" class="slick-arrow slick-carousel-control-next"></button>',
        // prevArrow: '<button type="button" class="slick-arrow slick-carousel-control-prev"></button>',
        slidesToShow: 1,
        centerPadding: '50px', //default 50px
        slidesToScroll: 1,
        rows: 0,
        responsive: [
            {
                breakpoint: 1024,
                settings: {
                    appendArrows: '.nav-arrows2',
                    nextArrow: '<button type="button" class="slick-arrow slick-carousel-control-next"></button>',
                    prevArrow: '<button type="button" class="slick-arrow slick-carousel-control-prev"></button>',
                    slidesToShow: 1,
                    slidesToScroll: 1,
                    infinite: true,
                    arrows: true,
                    dots: true
                }
            },
            {
                breakpoint: 600,
                settings: {
                    appendArrows: '.nav-arrows2',
                    nextArrow: '<button type="button" class="slick-arrow slick-carousel-control-next"></button>',
                    prevArrow: '<button type="button" class="slick-arrow slick-carousel-control-prev"></button>',
                    slidesToShow: 1,
                    slidesToScroll: 1,
                    infinite: true,
                    arrows: true,
                    dots: true
                }
            },
            {
                breakpoint: 480,
                settings: {
                    appendArrows: '.nav-arrows2',
                    nextArrow: '<button type="button" class="slick-arrow slick-carousel-control-next"></button>',
                    prevArrow: '<button type="button" class="slick-arrow slick-carousel-control-prev"></button>',
                    slidesToShow: 1,
                    slidesToScroll: 1,
                    dots: false
                }
            }
        ]
    };
//====================================
    // End Slick Carousel Work Gallery
    //====================================



    $scope.slickConfigWorkGallery3 = {
        method: {},
        arrows: false,
        dots: true,
        infinite: true,
        speed: 300,
        appendDots: '.nav-dots3',
        // appendArrows: '.nav-arrows',
        // nextArrow: '<button type="button" class="slick-arrow slick-carousel-control-next"></button>',
        // prevArrow: '<button type="button" class="slick-arrow slick-carousel-control-prev"></button>',
        slidesToShow: 1,
        centerPadding: '50px', //default 50px
        slidesToScroll: 1,
        rows: 0,
        responsive: [
            {
                breakpoint: 1024,
                settings: {
                    appendArrows: '.nav-arrows3',
                    nextArrow: '<button type="button" class="slick-arrow slick-carousel-control-next"></button>',
                    prevArrow: '<button type="button" class="slick-arrow slick-carousel-control-prev"></button>',
                    slidesToShow: 1,
                    slidesToScroll: 1,
                    infinite: true,
                    arrows: true,
                    dots: true
                }
            },
            {
                breakpoint: 600,
                settings: {
                    appendArrows: '.nav-arrows3',
                    nextArrow: '<button type="button" class="slick-arrow slick-carousel-control-next"></button>',
                    prevArrow: '<button type="button" class="slick-arrow slick-carousel-control-prev"></button>',
                    slidesToShow: 1,
                    slidesToScroll: 1,
                    infinite: true,
                    arrows: true,
                    dots: true
                }
            },
            {
                breakpoint: 480,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1,
                    dots: false
                }
            }
        ]
    };
//====================================
    // End Slick Carousel Work Gallery
    //====================================


    $scope.slickConfigWorkGallery4 = {
        method: {},
        arrows: false,
        dots: true,
        infinite: true,
        speed: 300,
        appendDots: '.nav-dots4',
        // appendArrows: '.nav-arrows',
        // nextArrow: '<button type="button" class="slick-arrow slick-carousel-control-next"></button>',
        // prevArrow: '<button type="button" class="slick-arrow slick-carousel-control-prev"></button>',
        slidesToShow: 1,
        centerPadding: '50px', //default 50px
        slidesToScroll: 1,
        rows: 0,
        responsive: [
            {
                breakpoint: 1024,
                settings: {
                    appendArrows: '.nav-arrows4',
                    nextArrow: '<button type="button" class="slick-arrow slick-carousel-control-next"></button>',
                    prevArrow: '<button type="button" class="slick-arrow slick-carousel-control-prev"></button>',
                    slidesToShow: 1,
                    slidesToScroll: 1,
                    infinite: true,
                    arrows: true,
                    dots: true
                }
            },
            {
                breakpoint: 600,
                settings: {
                    appendArrows: '.nav-arrows4',
                    nextArrow: '<button type="button" class="slick-arrow slick-carousel-control-next"></button>',
                    prevArrow: '<button type="button" class="slick-arrow slick-carousel-control-prev"></button>',
                    slidesToShow: 1,
                    slidesToScroll: 1,
                    infinite: true,
                    arrows: true,
                    dots: true
                }
            },
            {
                breakpoint: 480,
                settings: {
                    appendArrows: '.nav-arrows4',
                    nextArrow: '<button type="button" class="slick-arrow slick-carousel-control-next"></button>',
                    prevArrow: '<button type="button" class="slick-arrow slick-carousel-control-prev"></button>',
                    slidesToShow: 1,
                    arrows: true,
                    slidesToScroll: 1,
                    dots: false
                }
            }
        ]
    };
//====================================
    // End Slick Carousel Work Gallery
    //====================================


    $scope.slickConfigWorkGallery5 = {
        method: {},
        arrows: false,
        dots: true,
        infinite: true,
        speed: 300,
        appendDots: '.nav-dots5',
        // appendArrows: '.nav-arrows',
        // nextArrow: '<button type="button" class="slick-arrow slick-carousel-control-next"></button>',
        // prevArrow: '<button type="button" class="slick-arrow slick-carousel-control-prev"></button>',
        slidesToShow: 1,
        centerPadding: '50px', //default 50px
        slidesToScroll: 1,
        rows: 0,
        responsive: [
            {
                breakpoint: 1024,
                settings: {
                    appendArrows: '.nav-arrows5',
                    nextArrow: '<button type="button" class="slick-arrow slick-carousel-control-next"></button>',
                    prevArrow: '<button type="button" class="slick-arrow slick-carousel-control-prev"></button>',
                    slidesToShow: 1,
                    slidesToScroll: 1,
                    infinite: true,
                    arrows: true,
                    dots: true
                }
            },
            {
                breakpoint: 600,
                settings: {
                    appendArrows: '.nav-arrows5',
                    nextArrow: '<button type="button" class="slick-arrow slick-carousel-control-next"></button>',
                    prevArrow: '<button type="button" class="slick-arrow slick-carousel-control-prev"></button>',
                    slidesToShow: 1,
                    slidesToScroll: 1,
                    infinite: true,
                    arrows: true,
                    dots: true
                }
            },
            {
                breakpoint: 480,
                settings: {
                    appendArrows: '.nav-arrows5',
                    nextArrow: '<button type="button" class="slick-arrow slick-carousel-control-next"></button>',
                    prevArrow: '<button type="button" class="slick-arrow slick-carousel-control-prev"></button>',
                    slidesToShow: 1,
                    slidesToScroll: 1,
                    arrows: true,
                    dots: false
                }
            }
        ]
    };
//====================================
    // End Slick Carousel Work Gallery
    //====================================


    $scope.slickConfigWorkGallery6 = {
        method: {},
        arrows: false,
        dots: true,
        infinite: true,
        speed: 300,
        appendDots: '.nav-dots6',
        // appendArrows: '.nav-arrows',
        // nextArrow: '<button type="button" class="slick-arrow slick-carousel-control-next"></button>',
        // prevArrow: '<button type="button" class="slick-arrow slick-carousel-control-prev"></button>',
        slidesToShow: 1,
        centerPadding: '50px', //default 50px
        slidesToScroll: 1,
        rows: 0,
        responsive: [
            {
                breakpoint: 1024,
                settings: {
                    appendArrows: '.nav-arrows6',
                    nextArrow: '<button type="button" class="slick-arrow slick-carousel-control-next"></button>',
                    prevArrow: '<button type="button" class="slick-arrow slick-carousel-control-prev"></button>',
                    slidesToShow: 1,
                    slidesToScroll: 1,
                    infinite: true,
                    arrows: true,
                    dots: true
                }
            },
            {
                breakpoint: 600,
                settings: {
                    appendArrows: '.nav-arrows6',
                    nextArrow: '<button type="button" class="slick-arrow slick-carousel-control-next"></button>',
                    prevArrow: '<button type="button" class="slick-arrow slick-carousel-control-prev"></button>',
                    slidesToShow: 1,
                    slidesToScroll: 1,
                    infinite: true,
                    arrows: true,
                    dots: true
                }
            },
            {
                breakpoint: 480,
                settings: {
                    appendArrows: '.nav-arrows6',
                    nextArrow: '<button type="button" class="slick-arrow slick-carousel-control-next"></button>',
                    prevArrow: '<button type="button" class="slick-arrow slick-carousel-control-prev"></button>',
                    slidesToShow: 1,
                    slidesToScroll: 1,
                    arrows: true,
                    dots: false
                }
            }
        ]
    };
//====================================
    // End Slick Carousel Work Gallery
    //====================================

    //====================================
    // Slick Carousel Well Boring
    //====================================
    $scope.slickConfigBoring = {
        method: {},
        dots: false,
        infinite: true,
        speed: 300,
        // appendDots: '.nav-dots',
        appendArrows: '.nav-arrows',
        nextArrow: '<button type="button" class="slick-arrow slick-carousel-control-next"></button>',
        prevArrow: '<button type="button" class="slick-arrow slick-carousel-control-prev"></button>',
        slidesToShow: 1,
        centerPadding: '70px', //default 50px
        slidesToScroll: 1,
        rows: 0,
        responsive: [
            {
                breakpoint: 1024,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 1,
                    infinite: true,
                    dots: false
                }
            },
            {
                breakpoint: 600,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 1,
                    dots: false
                }
            },
            {
                breakpoint: 480,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1,
                    dots: false
                }
            }
        ]
    };


    //====================================
    // End Slick Carousel Well Boring
    //====================================


    //====================================
    // Slick Carousel Certificates
    //====================================


    ///////////////////////////////// SLICK CONFIG
    $scope.slickConfigCertificates = {
        method: {},
        dots: false,
        infinite: true,
        speed: 300,
        // appendDots: '.nav-dots',
        appendArrows: '.nav-arrows',
        nextArrow: '<button type="button" class="slick-arrow slick-carousel-control-next"></button>',
        prevArrow: '<button type="button" class="slick-arrow slick-carousel-control-prev"></button>',
        slidesToShow: 3,
        centerPadding: '70px', //default 50px
        slidesToScroll: 1,
        rows: 0,
        responsive: [
            {
                breakpoint: 1024,
                settings: {
                    slidesToShow: 3,
                    slidesToScroll: 1,
                    infinite: true,
                    dots: false
                }
            },
            {
                breakpoint: 600,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 1,
                    dots: false
                }
            },
            {
                breakpoint: 480,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1,
                    dots: false
                }
            }
        ]
    };
    ///////////////////////////////// END SLICK CONFIG
    //====================================
    // End Slick Carousel Certificates
    //====================================


    //====================================
    // Slick Carousel Reviews
    //====================================

    $scope.isReviewsLoaded  = false;
    ///////////////////////////////// SLICK CONFIG
    $scope.slickConfigReviews = {
        method: {},
        dots: true,
        // enabled: false,
        infinite: false,
        speed: 300,
        event: {
            init: function(){




            }
        },
        appendDots: '.nav-dots',
        appendArrows: '.nav-arrows',
        nextArrow: '<button type="button" class="slick-arrow slick-carousel-control-next"></button>',
        prevArrow: '<button type="button" class="slick-arrow slick-carousel-control-prev"></button>',
        slidesToShow: 2,
        centerPadding: '70px', //default 50px
        slidesToScroll: 1,
        rows: 0,
        responsive: [
            {
                breakpoint: 1024,
                settings: {
                    slidesToShow: 2,
                    arrows: false,
                    slidesToScroll: 1,
                    infinite: true,
                    dots: true
                }
            },
            {
                breakpoint: 600,
                settings: {
                    arrows: true,
                    nextArrow: '<button type="button" class="slick-arrow slick-carousel-control-next"></button>',
                    prevArrow: '<button type="button" class="slick-arrow slick-carousel-control-prev"></button>',
                    slidesToShow: 2,
                    slidesToScroll: 1,
                    dots: false
                }
            },
            {
                breakpoint: 480,
                settings: {
                    arrows: true,
                    appendArrows: '.nav-arrows',
                    nextArrow: '<button type="button" class="slick-arrow slick-carousel-control-next"></button>',
                    prevArrow: '<button type="button" class="slick-arrow slick-carousel-control-prev"></button>',
                    slidesToShow: 1,
                    slidesToScroll: 1,
                    dots: false
                }
            }
        ]
    };
    ///////////////////////////////// END SLICK CONFIG
    //====================================
    // End Slick Carousel Reviews
    //====================================


}]);

