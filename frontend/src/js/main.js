var consoleTrace = function(){
  if (window.console && console.trace) {
    console.trace.apply(console, arguments);
  }
};

var App = {

  swipers: [],

  transitionNameEvent: (function(){
    var div = document.createElement('div');
    var transition = {
      transition: 'transitionend',
      oTransition: 'oTransitionEnd',
      mozTransition: 'transitionend',
      webkitTransition: 'webkitTransitionEnd'
    };
    var output;
    for (var name in transition){
      if (div.style[name] !== undefined){
        output = transition[name];
        break;
      }
    }

    if (output === undefined){
      output = false;
    }

    return output;
  })(),

  init: function(){
    this.nav();
    this.seo();
    this.lang();
    this.tabs();
    this.menu();
    this.header();
    this.filter();
    this.social();
    this.countUp();

    this.bannerProduct();
    this.product();
    this.product({
      item: ".banner-product-open",
      image: ".banner-product-open__image",
      imageTarget: ".banner-product-open__image-target",
      imagePreload: ".banner-product-open__image-preload",
      imageOpen: "banner-product-open__image_open"
    });

    this.pagination();
    this.detailGallery();
    this.customScroll();
    this.swiper('.swiper-container.js-swiper', 'body');
    this.swiperVideoGallery();
    this.swiperDocGallery();
    this.contentPopup();
    this.magnificPopup();
    this.pointAnimation();
    this.logoAnimation();
    this.accordion();
    this.fileInput();
    this.factsTurn();
    this.dotdotdot();
    this.tooltipster();
    this.mask.phone.init();
  },

  initOnLoad: function(){
    this.breadcrumbs();
  },

  initOnResize: function(){
    this.pagination();
    this.dotdotdot();
  },

  popupAnimate: function(context){

    setTimeout(function(){
      $(context).each(function(){
        var self = $(this);

        if (self.hasClass("popup-animate-close-top")) {
          var delayClose = self.attr("data-delay-close");
          var close = $(".mfp-close", self);

          if (delayClose) {
            close.css({
              'animationDelay': delayClose
            });
          }
        }

        self.addClass("show");
      });

      $(".popup-animate-scale, .popup-animate-left, .popup-animate-top", context || 'body').each(function(){
        var self = $(this);
        var delay = self.attr("data-delay");

        if (delay) {
          self.css({
            'transitionDelay': delay
          });
        }

        self.addClass("show");
      });
    }, 0);

  },

  mask: {

    phone: {

      arm: function(){
        return {
          start: 4,

          config: function(){
            var _this = this;

            return {
              kronosPlaceholder: "+374 __ __-__-___",

              clearIncomplete: false,
              mask: "+374 99 99-99-999",
              placeholder: "_",

              oncomplete: function () {
                var that = this;
                var input = $(that);
                var value = input.val();

                if (_this.check(value)) {
                  input.css('border-color', '');
                } else {
                  input.css('border-color', 'red');
                  input.val("").inputmask("remove");
                  setTimeout(function () {
                    input.inputmask( _this.config() );
                  }, 0);

                }

              }
            }

          },
          check: function(value){
            return true;
          }

        };
      },

      ky: function(){
        return {
          start: 4,

          config: function(){
            var _this = this;

            return {
              kronosPlaceholder: "+996 __ __-__-___",

              clearIncomplete: false,
              mask: "+\\9\\96 99 99-99-999",
              placeholder: "_",

              oncomplete: function () {
                var that = this;
                var input = $(that);
                var value = input.val();

                if (_this.check(value)) {
                  input.css('border-color', '');
                } else {
                  input.css('border-color', 'red');
                  input.val("").inputmask("remove");
                  setTimeout(function () {
                    input.inputmask( _this.config() );
                  }, 0);

                }

              }
            }

          },
          check: function(value){
            return true;
          }

        };
      },

      kz: function(){
        return {
          start: 2,
          config: function(){
            var _this = this;

            return {
              kronosPlaceholder: "+7 ___ ___-__-__",

              clearIncomplete: false,
              mask: "+7 999 999-99-99",
              placeholder: "_",

              oncomplete: function () {
                var that = this;
                var input = $(that);
                var value = input.val();

                if (_this.check(value)) {
                  input.css('border-color', '');
                } else {
                  input.css('border-color', 'red');
                  input.val("").inputmask("remove");
                  setTimeout(function () {
                    input.inputmask( _this.config() );
                  }, 0);

                }

              }
            }

          },
          check: function(value){
            value = value.replace(/[^0-9+]/gi, '');
            value = value.slice(this.start);

            var status = true;

            switch(value){
              case '0000000000':
              case '1111111111':
              case '2222222222':
              case '3333333333':
              case '4444444444':
              case '5555555555':
              case '6666666666':
              case '7777777777':
              case '8888888888':
              case '9999999999':
                status = false;
                break;
              default:
                var code = value.slice(0, 3);
                switch(code){
                  case "000":
                    status = false;
                    break;
                }
            }

            if (value.length !== 10){
              status = false;
            }

            return status;
          }
        };
      },

      ru: function(){
        return {
          start: 2,
          config: function(){
            var _this = this;

            return {
              kronosPlaceholder: "+7 ___ ___-__-__",

              clearIncomplete: false,
              mask: "+7 999 999-99-99",
              placeholder: "_",

              oncomplete: function () {
                var that = this;
                var input = $(that);
                var value = input.val();

                if (_this.check(value)) {
                  input.css('border-color', '');
                } else {
                  input.css('border-color', 'red');
                  input.val("").inputmask("remove");
                  setTimeout(function () {
                    input.inputmask( _this.config() );
                  }, 0);

                }

              }
            }

          },
          check: function(value){
            value = value.replace(/[^0-9+]/gi, '');
            value = value.slice(this.start);

            var status = true;

            switch(value){
              case '0000000000':
              case '1111111111':
              case '2222222222':
              case '3333333333':
              case '4444444444':
              case '5555555555':
              case '6666666666':
              case '7777777777':
              case '8888888888':
              case '9999999999':
                status = false;
                break;
              default:
                var code = value.slice(0, 3);
                switch(code){
                  case "000":
                    status = false;
                    break;
                }
            }

            if (value.length !== 10){
              status = false;
            }

            return status;
          }
        };
      },

      by: function(){
        return {
          start: 4,

          config: function(){
            var _this = this;

            return {
              kronosPlaceholder: "+375 __ __-__-___",

              clearIncomplete: false,
              mask: "+375 99 99-99-999",
              placeholder: "_",

              oncomplete: function () {
                var that = this;
                var input = $(that);
                var value = input.val();

                if (_this.check(value)) {
                  input.css('border-color', '');
                } else {
                  input.css('border-color', 'red');
                  input.val("").inputmask("remove");
                  setTimeout(function () {
                    input.inputmask( _this.config() );
                  }, 0);

                }

              }
            }

          },
          check: function(value){
            value = value.replace(/[^0-9+]/gi, '');
            value = value.slice(this.start);

            var codeAllowed = ["29", "44", "33", "25", "16", "17", "15", "21", "22", "23"];
            var status = true;

            switch(value){
              case '000000000':
              case '111111111':
              case '222222222':
              case '333333333':
              case '444444444':
              case '555555555':
              case '666666666':
              case '777777777':
              case '888888888':
              case '999999999':
                status = false;
                break;
            }

            var phone = value.slice(2);

            switch(phone){
              case '0000000':
              case '1111111':
              case '2222222':
              case '3333333':
              case '4444444':
              case '5555555':
              case '6666666':
              case '7777777':
              case '8888888':
              case '9999999':
                status = false;
                break;
            }

            var code = value.slice(0, 2);
            if (codeAllowed.indexOf(code) === -1){
              status = false;
            }

            if (value.length !== 9){
              status = false;
            }

            return status;
          }

        };
      },

      // init: function(selector, context, config){
      //   config = config || {};
      //
      //   var lang = this[ Kronos.lang() || "by" ]();
      //   var langConfig = lang.config();
      //
      //   $(selector || '.js-phone-masked', context || 'body').each(function(){
      //     var input = $(this);
      //     if (langConfig.kronosPlaceholder){
      //       input.attr("placeholder", langConfig.kronosPlaceholder);
      //     }
      //
      //     if (input.attr("type") !== "tel"){
      //       input.attr("type", "tel");
      //     }
      //
      //     input.inputmask( $.extend( langConfig, config ) );
      //   });
      // },
      init: function(context, config){
        var $this = this;

        $(".input-phone", context || 'body').each(function(){
          var self = $(this);
          var lang = self.attr("data-lang");
          var langData = $this[lang || "by"]();
          var langConfig = langData.config();
          var input = $(".input-phone__input input", self);
          var fakePlaceholder = $(".input-phone__placeholder", self);
          var fakePlaceholderCode = $(".input-phone__code", fakePlaceholder);
          var fakePlaceholderPhone = $(".input-phone__phone", fakePlaceholder);

          if (langConfig.kronosPlaceholder){
            input.attr("placeholder", langConfig.kronosPlaceholder);
          }

          var configResult = function(){
            return $.extend( langConfig, config || {}, {
              clearMaskOnLostFocus: false
            } );
          };

          var setFakePlaceholder = function(){
            var value = input.val();
            if (!value.length) {
              value = langConfig.kronosPlaceholder;
            }

            var placeholderIndex = value.indexOf(langConfig.placeholder);
            var code, phone;
            if (placeholderIndex >= 0) {
              code = value.slice(0, placeholderIndex);
              phone = value.slice(placeholderIndex);
            } else {
              code = value;
              phone = "";
            }

            fakePlaceholderCode.html(code);
            fakePlaceholderPhone.html(phone);
          };

          self
            .off("changeLang")
            .on("changeLang", function(e, data){
              var langChange = data.lang;
              if (langChange){
                self.attr("data-lang", langChange);

                input.inputmask("remove");
                input.val("");

                lang = langChange;
                langData = $this[lang || "by"]();
                langConfig = langData.config();

                setFakePlaceholder();
              }
            });

          fakePlaceholder
            .off("focus")
            .on("focus", function(e){
              self.addClass("hide_placeholder");
              input.focus();

              if (!input.data("_inputmask_opts")) {
                input.inputmask( configResult() );
              }
            });

          input
            .off("focus")
            .off("blur")
            .on("blur", function(e){


              setFakePlaceholder();

              self.removeClass("hide_placeholder");
            });

        });

      }

    }

  },

  tooltipster: function(){

    $('.js-tooltip').each(function(){
      var self = $(this);
      var tooltipTarget = $(".js-tooltip-target", self);

      self.tooltipster({
        animationDuration: 0,
        delay: 0,
        theme: ["tooltipster-kronos"],
        functionPosition: function(instance, helper, position){
          var origin = $(helper.origin);
          var originPositionX = origin.attr("data-position-x");
          var originOffsetX = origin.attr("data-offset-x");
          var originOffsetY = origin.attr("data-offset-y");
          var originOffset;
          var positionX = [];
          var positionY = [];
          var direction, value;

          if (tooltipTarget.length){
            originOffset = tooltipTarget.offset();
          } else {
            originOffset = origin.offset();
          }

          if (originPositionX){
            positionX = originPositionX.split(";");
          }

          if (positionX.length) {

            switch(positionX[0]){
              case "left":
                position.coord.left = originOffset.left;

                if (typeof positionX[1] === "string" && positionX[1].length > 1) {
                  direction = positionX[1].charAt(0);
                  value = +positionX[1].slice(1) || 0;

                  switch(direction) {
                    case "+":
                      position.coord.left += value;
                      break;
                    case "-":
                      position.coord.left -= value;
                      break;
                  }
                }

                break;
            }

          }

          if (typeof originOffsetY === "string" && originOffsetY.length > 1) {
            direction = originOffsetY.charAt(0);
            value = +originOffsetY.slice(1) || 0;

            switch(direction) {
              case "+":
                position.coord.top += value;
                break;
              case "-":
                position.coord.top -= value;
                break;
            }
          }

          if (typeof originOffsetX === "string" && originOffsetX.length > 1) {
            direction = originOffsetX.charAt(0);
            value = +originOffsetX.slice(1) || 0;

            switch(direction) {
              case "+":
                position.coord.left += value;
                break;
              case "-":
                position.coord.left -= value;
                break;
            }
          }

          return position;
        }
      });

    });

  },

  dotdotdot: function(context){

    $(".js-dotdotdot", context || "body").each(function(){
      var self = $(this);
      var dotdotdot = self.data("dotdotdot");

      if (dotdotdot) return;

      var height = self.height();
      var config = self.data("config-dotdotdot") || {};

      var configResult = $.extend({
        truncate: "letter",
        height: Math.ceil(height),
        watch: true,
        callback: function(isTruncated){

        }
      }, config);

      self.dotdotdot(configResult);

    });

  },

  cloudZoom: function(img, options){
    options = options || {};

    if (img.length){
      img.CloudZoom(options);
    }
  },

  social: function(){
    $(document)
      .on("click", ".js-toggle-social", function(e){
        e.preventDefault();
        var self = $(this);
        var social = self.closest(".social");

        social.toggleClass("social_open");
      });
  },

  breadcrumbs: function(){
    var win = $(window);

    function breadcrumbsInit(){
      var scrollTop = win.scrollTop();
      var scrollBottom = scrollTop + win.height();

      $(".breadcrumbs").each(function(){
        var self = $(this);
        var offset = self.offset();

        if (scrollTop <= offset.top && scrollBottom >= (offset.top + self.height())) {
          self.addClass("breadcrumbs_animate");
        }
      });
    }

    breadcrumbsInit();
    win.on("scroll", function(){
      breadcrumbsInit();
    });
  },

  seo: function(){
    $(document)
      .on("click", ".js-seo-toggle", function(){
        var self = $(this);
        var text = $("span", self);
        var btn = event.target;
        var textShow = self.attr("data-show");
        var textHide = self.attr("data-hide");
        var root = self.closest(".seo");
        var slide = $(".seo__slide", root);

        if (slide.is(":visible")) {
          text.html(textShow);
          slide.slideUp();
          btn.classList.remove('dot-link-one-line__name-active');
        } else {
          text.html(textHide);
          slide.slideDown();
          btn.classList.add('dot-link-one-line__name-active');
        }
      });

  },

  pagination: function(show){
    show = (show !== undefined) ? show : false;

    var $this = this;

    $(".js-pagination").each(function(){
      var self = $(this);
      var selfWidth = self.width();
      var selfOffset = self.offset();
      var selfTotal = selfWidth + selfOffset.left;

      var list = $(".pagination__list > ul", self);
      var listWidth = list.width();
      var listOffset = list.offset();
      var listTotal = listWidth + listOffset.left;
      var items, prevItems, nextItems, active;

      if (listTotal > selfTotal) {
        active = $(".pagination__item_active", self);
        prevItems = active.prevAll(".pagination__item:visible");
        nextItems = active.nextAll(".pagination__item:visible");

        if (prevItems.length > nextItems.length) {
          prevItems.eq(prevItems.length - 1).hide();
        } else {
          nextItems.eq(nextItems.length - 1).hide();
        }

        if (!show) {
          $this.pagination();
        }
      } else {
        // active = $(".pagination__item_active", self);
        // prevItems = active.prevAll(".pagination__item:visible");
        // nextItems = active.nextAll(".pagination__item:visible");
        //
        // if (prevItems.length > nextItems.length) {
        //   active.nextAll(".pagination__item:hidden").eq(0).show();
        // } else {
        //   var hidden = active.prevAll(".pagination__item:hidden");
        //   hidden.eq(0).show();
        // }
        //
        // $this.pagination(true);
      }

    });

  },

  countUp: function(){

    $(".js-countUp").each(function(){
      var self = $(this);
      var start = self.attr("data-start");
      var end = self.attr("data-end");
      var suffix = self.attr("data-suffix");
      var duration = self.attr("data-duration");

      var config = {
        separator: "",
        suffix: "",
        duration: 4
      };

      if (start){
        config.startVal = +start;
      }

      if (suffix) {
        config.suffix = suffix;
      }

      if (+duration) {
        config.duration = +duration;
      }

      var countUp = new CountUp(this, +end, config);

      self.data("countUp", countUp);
    });

    $(window).on("scroll", function(){
      var window = $(this);
      var scrollTop = window.scrollTop();

      $(".js-countUp").each(function(){
        var self = $(this);
        var countUp = self.data("countUp");
        if (!countUp || !countUp.paused) return;


        var increment = self.attr("data-increment");
        var incrementDelay = self.attr("data-increment-delay");
        var offset = self.offset();
        var height = self.height();

        if (offset.top >= scrollTop && (offset.top + height) <= scrollTop + window.height()) {

          if (!countUp.error) {
            countUp.start(function(){
              if (increment && incrementDelay) {
                setTimeout(function(){
                  countUp.update(countUp.endVal + +increment);
                }, +incrementDelay);
              }
            });
          } else {
            console.error(countUp.error);
          }

        }
      });
    }).trigger("scroll");

  },

  bannerProduct: function(){

    $(document)
      .on("mouseleave", ".banner-product", function(){
        var self = $(this);
        var countUp = $(".js-banner-product-countUp", self);

        countUp.each(function(){
          var $self = $(this);
          var $countUpTimer = $self.data("countUpTimer");
          if ($countUpTimer) {
            clearTimeout($countUpTimer);
          }
        });
      })
      .on("mouseenter", ".banner-product", function(){
        var self = $(this);
        var countUp = $(".js-banner-product-countUp", self);

        countUp.each(function(){
          var $self = $(this);
          var $start = $self.attr("data-start");
          var $end = $self.attr("data-end");

          if ($self.data("countUp")) {
            return;
          }

          if (typeof $start === "string" && typeof $end === "string") {

            let demo = new CountUp(this, +$end.replace(/[^0-9]/g, ""), {
              separator: " ",
              suffix: ' р.',
              duration: 4
            });

            if (!demo.error) {
              $self.data("countUpTimer", setTimeout(function(){
                $self.data("countUp", true);
                demo.start();
              }, 500));
            } else {
              console.error(demo.error);
            }

          }
        });
      });

  },

  product: function(options){

    options = $.extend({
      item: ".product",
      image: ".product__image",
      imageTarget: ".product__image-target",
      imagePreload: ".product__image-preload",
      imageOpen: "product__image_open",
      preloadShow: "show",
      pagination: ".pagination-line a",
      paginationActive: "active"
    }, options);

    var product = $(options.item);

    if (product.length) {

      var preloadImage = {
        show: function(preload){
          preload.addClass(options.preloadShow);
        },
        hide: function(preload){
          // setTimeout(function(){
            preload.removeClass(options.preloadShow);
          // }, 500);
        },
        open: function(link, productImagePreload, productImageTarget, fn){
          var siblings = link.siblings();
          var href = link.attr("href");
          var image;


          if (link.data("loadedImage")) {
            image = new Image();
            image.src = href;
            productImageTarget.html(image);
            siblings.removeClass(options.paginationActive);
            link.addClass(options.paginationActive);
            fn && fn();
          } else {

            this.show(productImagePreload);

            image = new Image();
            image.onerror = () => {
              consoleTrace("Ошибка загрузки изображения.");
              this.hide(productImagePreload);
            };

            image.onload = () => {
              productImageTarget.html(image);
              this.hide(productImagePreload);

              siblings.removeClass(options.paginationActive);
              link.addClass(options.paginationActive);
              link.data("loadedImage", true);

              fn && fn();
            };

            image.src = href;

          }

        }
      };

      product.each(function(){
        var self = $(this);
        var productImage = $(options.image, self);
        var productImageTarget = $(options.imageTarget, self);
        var productImagePreload = $(options.imagePreload, self);
        var productPagination = $(options.pagination, self);

        productImage.on("mouseleave", function(e){
          var $self = $(this);
          if ($self.hasClass(options.imageOpen)) {
            $self.removeClass(options.imageOpen);
          }
        });

        productImage.on("mousemove", function(e){
          var $self = $(this);
          var $count = $self.attr("data-count");
          var $position = $self.attr("data-position");

          if ($count) {
            var $offset = $self.offset();
            var $width = $self.width();
            var $offsetX = e.clientX - $offset.left;
            var $index = Math.ceil(($offsetX / $width) * $count);

            if ($index < 1) {
              $index = 1;
            } else if ($index > $count) {
              $index = $count;
            }

            if ($index != $position) {
              preloadImage.open(
                productPagination.eq($index - 1),
                productImagePreload,
                productImageTarget,
                function(){
                  productImage.attr("data-position", $index)
                }
              );
            }

            if ($index == $count) {
              if (!$self.hasClass(options.imageOpen)) {
                $self.addClass(options.imageOpen);
              }
            } else {
              if ($self.hasClass(options.imageOpen)) {
                $self.removeClass(options.imageOpen);
              }
            }
          }
        });

        self.on("click", options.pagination, function(e){
          e.preventDefault();
          var $self = $(this);
          var $index = $self.index();

          preloadImage.open(
            $self,
            productImagePreload,
            productImageTarget,
            function(){
              productImage.attr("data-position", $index + 1)
            }
          );

        });

      });

    }

  },

  filter: function filter() {
    var all = $(".js-filter-root");
    if (!all.length) return;
    hundleCheckbox();
    $(document).on('mouseenter', '.js-filter-root', function() {
      this.classList.add('open');
      setTimeout(() => this.querySelector('.filter__drop').classList.add('top'));
    });
    $(document).on('mouseleave', '.js-filter-root', function() {
      this.classList.remove('open');
      this.querySelector('.filter__drop').classList.remove('top');
    });
    $(document).on('click', 'input.check-cust', () => hundleCheckbox());
    function hundleCheckbox() {
      [].slice.call($('.js-filter-root')).forEach(t => {
        var count = [].slice.call(t.querySelectorAll('input.check-cust')).filter(input => input.checked).length;
        count ? t.classList.add('filtered') : t.classList.remove('filtered');
        t.querySelector('.filter__count').innerHTML = count ? count : '&nbsp;';
      });
    }
  },

  accordion: function(){
    $(document).on("click", ".accordion__close", function (e) {
      var self = $(this);
      var body = self.parents(".accordion__body");
      var item = self.parents('.accordion__item');

      body.fadeOut({
        complete: function(){
          item.removeClass('active');
        }
      });

      $('body').removeClass('accordion-popup-active');
    });

    $(document).on("click", ".accordion__head", function (e) {
      var self = $(this);
      var item = self.parents('.accordion__item');
      var body = self.next(".accordion__body");

      if (self.parents('.accordion_mobile-popup').length && window.innerWidth < 768) {

        if (!item.hasClass('active')) {
          $('body').addClass('accordion-popup-active');
          body.fadeIn({
            start: function(){
              item.addClass("active");
            }
          });
        }

      }

      else {
        if (!item.hasClass('active')) {
          $('.accordion__item').each(function () {
            var s = $(this);
            if (s.hasClass('active')) {
              s.find(".accordion__body").slideUp({
                start: function(){
                  s.removeClass('active');
                }
              });
            }
          });

          body.slideDown({
            start: function(){
              item.addClass("active");
            }
          });
        }
        else {
          body.slideUp({
            start: function(){
              item.removeClass('active');
            }
          });
        }
      }

    });
  },

  nav: function(){

    var type = "click";

    if (type === "click") {

      $(document)
        .on("click", ".nav-drop > a", function(e){
          e.preventDefault();
          var self = $(this);
          var parent = self.parent();
          var drop = self.next(".nav__ul");

          if (drop.is(":hidden")) {
            drop.slideDown({
              start: function(){
                parent.addClass("nav-open");
              }
            });
          } else {
            drop.slideUp({
              complete: function(){
                parent.removeClass("nav-open");
              }
            });
          }
        });

    } else {

      $(document)
        .on("mouseenter", ".nav-drop", function(e){
          e.preventDefault();
          var self = $(this);
          var drop = self.children(".nav__ul");

          if (drop.is(":hidden")) {
            drop.slideDown({
              start: function(){
                self.addClass("nav-open");
              }
            });
          } else {
            drop.slideUp({
              complete: function(){
                self.removeClass("nav-open");
              }
            });
          }
        })
        .on("mouseleave", ".nav-drop", function(e){
          e.preventDefault();
          var self = $(this);
          var drop = self.children(".nav__ul");

          if (drop.is(":hidden")) {
            drop.slideDown({
              start: function(){
                self.addClass("nav-open");
              }
            });
          } else {
            drop.slideUp({
              complete: function(){
                self.removeClass("nav-open");
              }
            });
          }
        });

    }

  },

  triggers: function(swiper){

    var lastZIndex = 2;

    $(document).on("mouseenter", ".trigger-item", function(e){
      var self = $(this);
      var parent = self.parent();

      // self.removeClass("trigger-item_right");

      swiper.slides.each(function(index){
        if (parent.is(this)) {
          var slidesPerView = swiper.params.slidesPerView;
          var active = swiper.activeIndex - 1;

          if ((active + slidesPerView) === index){
            self.addClass("trigger-item_right");
          }
        }
      });

      lastZIndex++;

      self.css('zIndex', lastZIndex);
      self.addClass("animated-blobs");

      var blobs = $(".trigger-item__blobs", self);
      var countBlobs = blobs.children().length;
      var count = 0;

      blobs.off("transitionend").on("transitionend", function(e){
        count++;
        if (count === countBlobs){
          self.addClass("animated-block");
        }
      });
    });

    $(document).on("mouseleave", ".trigger-item", function(e){
      var self = $(this);

      var blobs = $(".trigger-item__blobs", self);
      var countBlobs = blobs.children().length;
      var count = 0;

      if (self.hasClass("animated-block")) {
        self.removeClass("animated-blobs").removeClass("animated-block");

        blobs.off("transitionend").on("transitionend", function(e){
          count++;
          if (count === countBlobs){
            self.removeClass("trigger-item_right");
            self.css('zIndex', '');
          }
        });
      } else if (self.hasClass("animated-blobs")) {
        self.removeClass("animated-blobs");

        blobs.off("transitionend").on("transitionend", function(e){
          count++;
          if (count === countBlobs){
            self.removeClass("trigger-item_right");
            self.css('zIndex', '');
          }
        });
      }


    });

    $(document).on("mouseenter", ".triggers .swiper-button", function(e) {
      $(this).parents('.triggers-wrap').addClass('triggers-overflow');
    });

    $(document).on("mouseleave", ".triggers .swiper-button", function(e) {
      $(this).parents('.triggers-wrap').removeClass('triggers-overflow');
    });

  },

  header: function(){
    var header = $(".header");
    var headerDesktop = $(".header__desktop");

    if (header.length && headerDesktop.length && header.is(":visible")) {

      // При прокрутке шапка должна фиксироваться и сокращаться до 1 строки — https://yadi.sk/i/B5V1TjZJBCLLOQ.
      // После первых двух экранов шапку скрываем вообще, но при любой прокрутке вверх возвращаем обратно сокращённый однострочный вариант.
      // На верхнем экране шапка разворачивается до полной версии

      var win = $(window);
      var scrollTopLast = 0;
      var scrollDirection = '=';

      win.on("scroll.header", function(e){
        var height = win.height();
        var scrollTop = win.scrollTop();

        if (scrollTopLast >= 0) {
          if (scrollTopLast < scrollTop) {
            scrollDirection = 'down';
          } else if (scrollTopLast > scrollTop) {
            scrollDirection = 'up';
          } else {
            scrollDirection = '=';
          }
        }

        if (scrollTop > 0) {
          if (!header.hasClass("header_line")) {
            header.addClass("header_line");
            console.log("header add line");
          }
        } else {
          if (header.hasClass("header_line")) {
            header.removeClass("header_line");
            console.log("header remove line");
          }
        }

        if (scrollTop > (height * 2)) {

          switch(scrollDirection){
            case "up":
              if (header.hasClass("header_hide")) {
                header.removeClass("header_hide");
                console.log("header remove hide");
              }
              break;
            case "down":
            default:
              if (!header.hasClass("header_hide")) {
                header.addClass("header_hide");
                console.log("header add hide");
              }
              break;
          }

        }

        scrollTopLast = scrollTop;
      }).trigger("scroll.header");
    }
  },

  logoAnimation: function(){

    var $this = this;
    var interval;
    var intervalDelay = 30000;
    var logo = $(".header__desktop .logo, .footer-logo");
    var logoAnimationClass = "logo_animation";
    var logoAnimationFooterClass = "footer-logo_animation";

    var intervalInit = function(logo){

      logo.each(function(){
        var self = $(this);

        if (self.hasClass("logo")) {
          self.removeClass(logoAnimationClass);
          setTimeout(function(){
            self.one($this.transitionNameEvent, function(){
              self.removeClass(logoAnimationClass);
            });
            self.addClass(logoAnimationClass);
          }, 0);
        } else if (self.hasClass("footer-logo")) {
          self.removeClass(logoAnimationFooterClass);
          setTimeout(function(){
            self.one($this.transitionNameEvent, function(){
              self.removeClass(logoAnimationFooterClass);
            });
            self.addClass(logoAnimationFooterClass);
          }, 0);
        }

      });

    };

    interval = setInterval(function(){
      intervalInit(logo);
    }, intervalDelay);

    $(document)
      .on("mouseenter", ".header__desktop .logo", function(){
        if (interval) clearInterval(interval);
        logo.removeClass(logoAnimationClass);
      })
      .on("mouseleave", ".header__desktop .logo", function(){
        interval = setInterval(function(){
          intervalInit(logo);
        }, intervalDelay);
      });

  },

  contentPopup: function(){

    var $this = this;
    var body = $("body");
    var popupContent = $("#popup-content");
    var popupContentBody = $("#popup-content-body");

    $(document).on("click", ".js-open-content-popup", function(e){
      e.preventDefault();
      var self = $(this);
      var content = self.attr("data-content");
      var className = self.attr("data-class");

      if (className) {
        className = className.split(" ");
      } else {
        className = [];
      }

      if (content) {
        var contentEl = $(content);
        if (contentEl.length){
          var html = contentEl.html();
          popupContentBody.html(html);

          popupContent.data("popupClassName", className);

          if (className.length){
            className.forEach(function(cls){
              popupContent.addClass(cls);
            });
          }

          body.addClass("popup-content-open");
          popupContent.addClass("popup-content_open");
        }
      }
    });

    $(document).on("click", ".js-close-content-popup", function(e){
      e.preventDefault();

      body.removeClass("popup-content-open");
      popupContent.removeClass("popup-content_open");

      popupContent.one($this.transitionNameEvent, function(){
        var className = popupContent.data("popupClassName");

        if (className && className.length) {
          className.forEach(function(cls){
            popupContent.removeClass(cls);
          });
        }

        popupContent.data("popupClassName", []);
      });

    });

  },

  magnificPopup: function(){

    $(".popup-modal").magnificPopup({
      callbacks: {
        open: function(){},
        close: function(){},
      }
    });

    $(".popup-youtube").magnificPopup({
      type: 'iframe',
      mainClass: 'mfp-fade popup_video-gallery',
      removalDelay: 160,
      preloader: false,
      closeBtnInside: false,
      fixedContentPos: false
    });

    var popupDoc = $('.popup-doc');
    if (popupDoc.length) {
      popupDoc.each(function () {
        var popupDocInfo = $(this).find('.popup-doc-bar__info').html();
        var popupDocSrc = $(this).attr('data-doc');
        $(this).magnificPopup({
          items: {
            src: popupDocSrc
          },
          type: 'image',
          mainClass: 'popup_image',
          removalDelay: 160,
          preloader: false,
          closeBtnInside: false,
          fixedContentPos: false,
          image: {
            markup:
            '<div class="mfp-figure">'+
              '<div class="popup-doc-bar">'+ popupDocInfo +'</div>'+
              '<div class="mfp-img"></div>'+
            '</div>',
          }
        });
      });
    }

    var $videoGallery = $('.video-gallery');
    if ($videoGallery.length) {
      $videoGallery.each(function () {
        var $container = $(this);

        var $popupInfo = '';
        var $popupInfoBlock = $container.find('.video-gallery-info');
        if ($popupInfoBlock.length) { $popupInfo = $popupInfoBlock.html() }

        var $link = $container.find('.popup-youtube-gallery');

        var items = [];
        $link.each(function () {
          var $item = $(this);
          var type = 'iframe';

          var magItem = {
            src: $item.attr('href'),
            type: type
          };

          items.push(magItem);
        });

        $link.magnificPopup({
          items: items,
          type: 'iframe',
          mainClass: 'mfp-fade popup_video-gallery',
          removalDelay: 160,
          preloader: false,
          closeBtnInside: false,
          iframe: {
            markup: '<div class="mfp-iframe-scaler">' + $popupInfo +
            '<iframe class="mfp-iframe" frameborder="0" allowfullscreen></iframe>'+
            '</div>',
          },

          fixedContentPos: false,
          gallery: {
            enabled: true,
            navigateByImgClick: true
          },
          callbacks: {
            beforeOpen: function() {
              var index = $link.index(this.st.el);
              if (-1 !== index) {
                this.goTo(index);
              }
            }
          }
        });
      });
    }


    $(".popup-modal-ajax").each(function(){
      var self = $(this);
      var config = {
        type: "ajax",
        callbacks: {
          open: function(){},
          close: function(){},
        }
      };

      var mainClass = self.attr("data-mfp-mainClass");
      if (mainClass) {
        config['mainClass'] = mainClass;
      }

      self.magnificPopup(config);

    });

  },

  pointAnimation: function(){
    $(document).on("mouseenter", ".point-animation", function(){
      var self = $(this);

      if (self.hasClass("swiper-button-disabled")) {
        return;
      }

      self.removeClass("point-animation");

      setTimeout(function(){
        self.addClass("point-animation");
      }, 0);
    });
  },

  swiper: function(el, context, timeout){
    timeout = timeout || 0;

    var $this = this;
    var footer__bottom_slider;

    var paginationCustom = function(self, renderCustom){
      return {
        el: $('.swiper-pagination-kronos', self),
        type: 'custom',
        clickable: true,
        renderCustom: renderCustom || function(swiper, current, total){
          return current + ' of ' + total;
        }
      };
    };

    $(el, context).each(function(){
      var self = $(this);
      var root = self.closest(".js-swiper-root");
      if (!root.length) {
        root = self;
      }

      if (self.find('.swiper-slide').length < 2) {
        self.addClass('no-pagination');
      }

      var config = {
        preloadImages: true,
        lazy: true,
        navigation: {
          nextEl: $('.swiper-button-next-kronos', root),
          prevEl: $('.swiper-button-prev-kronos', root),
        },
        pagination: {
          el: $('.swiper-pagination-kronos', root),
          type: 'bullets',
          clickable: true,
        }
      };

      if (self.hasClass("triggers") && !self[0].parentNode.classList.contains('footer__triggers')) {
        config = $.extend(config, {
          loop: true,
          noSwiping: true,
          noSwipingClass: 'swiper-no-swiping',
          autoplay: {
            delay: 3000
          },
          slidesPerView: 4,
          breakpoints: {
            /*1699: {
              slidesPerView: 3
            },*/
            959: {
              slidesPerView: 2
            }
          },
          on: {
            init: function(){
              var swiper = this;

              swiper.$el
                .on("mouseenter", function(){
                  swiper.autoplay.stop();
                })
                .on("mouseleave", function(){
                  swiper.autoplay.start();
                });

              $this.triggers(swiper);
            },
          }
        });

      } if (self.hasClass("triggers") && self[0].parentNode.classList.contains('footer__triggers')) {
        config = $.extend(config, {
          loop: true,
          autoplay: {
            delay: 3000
          },
          slidesPerView: 4,
          breakpoints: {
            1699: {
              slidesPerView: 3
            },
            1439: {
              slidesPerView: 2
            }
          },
          on: {
            init: function(){
              var swiper = this;

              // swiper.$el
              //   .on("mouseenter", function(){
              //     swiper.autoplay.stop();
              //   })
              //   .on("mouseleave", function(){
              //     swiper.autoplay.start();
              //   });

              $this.triggers(swiper);
            },
            slidePrevTransitionStart: () => {
              setTimeout(() => footer__bottom_slider && footer__bottom_slider.slidePrev(), 10);
            },
            slideNextTransitionStart: () => {
              setTimeout(() => footer__bottom_slider && footer__bottom_slider.slideNext(), 10);
            },
          }
        });
      } else if (self.hasClass("detail-triggers_scroll")) {

        var count = 5;

        if (self.hasClass("detail-triggers_scroll_05")) {
          count = 5;
        } else if (self.hasClass("detail-triggers_scroll_06")){
          count = 6;
        } else if (self.hasClass("detail-triggers_scroll_07")){
          count = 7;
        }

        config = $.extend(config, {
          direction: "vertical",
          slidesPerView: count,
          loop: false,
          autoHeight: true,
          autoplay: {
            delay: 3000,
            disableOnInteraction: false
          },
          scrollbar: {
            el: $('.swiper-scrollbar', root),
            draggable: true,
          },
          on: {
            init: function(){
              var swiper = this;

              swiper.$el
                .on("mouseenter", function(){
                  swiper.autoplay.stop();
                })
                .on("mouseleave", function(){
                  swiper.autoplay.start();
                })
            }
          }
        });

      } else if (self.hasClass("views-products__swiper")) {

        config = $.extend(config, {
          slidesPerView: 2,
          spaceBetween: 16,
          pagination: paginationCustom(root, function(swiper, current, total){
            return 'Товары <span>' + current + '</span> из ' + total;
          }),
          breakpoints: {
            959: {
              slidesPerView: 4
            },
            767: {
              slidesPerView: 3
            },
            575: {
              slidesPerView: 2
            }
          }
        });

      } else if (self.hasClass("views-products-vertical__swiper")){

        config = $.extend(config, {
          direction: "vertical",
          slidesPerView: 3,
        });

      } else if (self.hasClass("views-products-horizontal__swiper")){

        config = $.extend(config, {
          slidesPerView: 3,
          pagination: paginationCustom(root, function(swiper, current, total){
            return 'Товары <span>' + current + '</span> из ' + total;
          }),
          breakpoints: {
            1699: {
              slidesPerView: 2
            },
            1439: {
              slidesPerView: 3
            },
            959: {
              spaceBetween: 16,
              slidesPerView: 4
            },
            767: {
              spaceBetween: 16,
              slidesPerView: 3
            },
            575: {
              spaceBetween: 16,
              slidesPerView: 2
            }
          }
        });

      } else if (self.hasClass("footer__bottom-slider")) {

        config = $.extend(config, {
          loop: true,
          // autoplay: {
          //   delay: 3000
          // },
          pagination: paginationCustom(root, function(swiper, current, total){
            return 'Фото <span>' + current + '</span> из ' + total;
          }),
          on: {
            init: function(){
              var swiper = footer__bottom_slider = this;

              swiper.$el
                .on("mouseenter", function(){
                  swiper.autoplay.stop();
                })
                .on("mouseleave", function(){
                  swiper.autoplay.start();
                })
            }
          }
        });

      } else if (self.hasClass("popup-shop-gallery")) {

        var slideChange = function(){
          var slide = $(this.slides[this.activeIndex]);
          if (slide.is("[data-name]")) {
            var popup = slide.closest(".popup");
            var name = $(".popup-shop__name", popup);
            name.html(slide.attr("data-name"));
          }
        };

        config = $.extend(config, {
          pagination: paginationCustom(root, function(swiper, current, total){
            return '<span>Фотография ' + current + ' из ' + total + '</span>';
          }),
          on: {
            init: slideChange,
            slideChange: slideChange
          }
        });

      } else if (self.hasClass("video-gallery_catalog")) {

        config = $.extend(config, {
          slidesPerView: 3,
          breakpoints: {
              // when window width is <= 576px
              576: {
                  slidesPerView: 1
              },
              // when window width is <= 1260px
              1260: {
                  slidesPerView: 2
              }
          }
        });

      } else if (self.hasClass("why-buy__swiper")) {

        config = $.extend(config, {
          loop: true,
          loopAdditionalSlides: 2,
          slidesPerView: 1,
          effect: "coverflow",
          centeredSlides: true,
          spaceBetween: 0,
          coverflowEffect: {
            rotate: 0,
            stretch: 120,
            depth: 500,
            modifier: 1,
            slideShadows : true,
          },
          pagination: paginationCustom(root, function(swiper, current, total){
            return '<span>' + current + '</span> из ' + total;
          }),
          on: {
            init: function(){
              var swiper = this;
              var el = $(swiper.$el);
              var win = $(window);

              win.on("scroll.whyBuy", function(){
                var scrollTop = win.scrollTop();
                var height = win.height();
                var elOffset = el.offset();

                if (scrollTop <= elOffset.top && scrollTop + height >= elOffset.top + el.height()) {
                  swiper.autoplay.start();

                  el
                    .on("mouseenter", function(){
                      swiper.autoplay.stop();
                    })
                    .on("mouseleave", function(){
                      swiper.autoplay.start();
                    });

                  win.off(".whyBuy");
                }
              }).trigger("scroll.whyBuy");

            }
          }
        });

      } else if (self.hasClass("video-gallery_head")) {

        config = $.extend(config, {
          slidesPerView: 2,
          breakpoints: {
            1699: {
              slidesPerView: 1
            }
          }
        });

      } else if (self.hasClass("video-gallery_head2")) {

        config = $.extend(config, {
          slidesPerView: 1,
          breakpoints: {
            1699: {
              slidesPerView: 1
            }
          }
        });

      } else if (self.hasClass("video-gallery_obzor")) {

        config = $.extend(config, {
          slidesPerView: 1,
          pagination: paginationCustom(root, function(swiper, current, total){
            return 'Видео <span>' + current + '</span> из ' + total;
          })
        });

      } else if (self.hasClass("banner__slider")) {

        var radiusDesktop = 9;
        var radiusMobile = 10.5;
        var lengthDesktop = (2 * Math.PI) * radiusDesktop;
        var lengthMobile = (2 * Math.PI) * radiusMobile;

        var autoplayBanner = {
          time: 0,
          paused: false,
          hover: false,

          init: function(swiper){
            var $this = this;
            var params = swiper.params;
            var autoplay = params.autoplay;
            var autoplayDelay = autoplay.delay;
            var lastTime = 0;

            (function loop(){
              setTimeout(function(){
                var startTime = Date.now();
                if (!$this.paused && !$this.hover) {
                  $this.time += (lastTime === 0) ? 0 : (startTime - lastTime);

                  var dt = $this.time >= autoplayDelay ? 1 : $this.time / autoplayDelay;

                  $this.onTime(swiper, dt);

                  if ($this.time >= autoplayDelay) {
                    $this.onNext(swiper);
                  }
                }

                lastTime = startTime;

                loop();
              }, 1000 / 60);
            })();

            this.stop(swiper);
            this.start(swiper)
          },

          start: function(swiper){
            this.paused = false;
          },

          stop: function(swiper){
            this.time = 0;
            this.paused = true;

            setTimeout(function(){
              swiper.autoplay.stop();
            }, 0);
          },
          pause: function(swiper){
            this.paused = true;
          },

          getPaginationElement: function(swiper){
            if (swiper.pagination.bullets) {
              for (var i = 0; i < swiper.pagination.bullets.length; i++) {
                var el = $(swiper.pagination.bullets[i]);
                if (el.hasClass("banner-pagination-bullet-active")) {
                  return {
                    el: el,
                    circleDesktop: el.find(".banner-pagination-bullet-desktop circle.banner-pagination-bullet-progress"),
                    circleMobile: el.find(".banner-pagination-bullet-mobile circle.banner-pagination-bullet-progress")
                  };
                }
              }
            }
            return false;
          },

          resetSvg: function(){
            $("circle.banner-pagination-bullet-progress").attr("stroke-dashoffset", 0);
          },

          onNext: function(swiper){
            this.stop(swiper);
            swiper.slideNext(); // -> emit slideChangeTransitionEnd
          },

          onTime: function(swiper, dt){
            var pe = this.getPaginationElement(swiper);
            if (pe) {
              pe.circleDesktop.attr("stroke-dashoffset", -(dt * lengthDesktop));
              pe.circleMobile.attr("stroke-dashoffset", -(dt * lengthMobile));

              if (dt >= 1) {
                $("circle.banner-pagination-bullet-progress").attr("stroke-dashoffset", 0);
              }
            }
          }
        };

        config = {
          loop: true,
          parallax: true,
          threshold: 50,
          autoplay: {
            delay: 5000
          },
          pagination: {
            el: $('.banner-pagination'),
            type: 'bullets',
            clickable: true,
            bulletClass: "banner-pagination-bullet",
            bulletActiveClass: "banner-pagination-bullet-active",
            renderBullet: function(index, className){
              return `

                <div class="${className}">
                  <svg width="20" height="20" class="banner-pagination-bullet-desktop">
                    <circle
                      r="9"
                      cx="10"
                      cy="10"
                      class="banner-pagination-bullet-normal" />
                    <circle
                      r="9"
                      cx="10"
                      cy="10"
                      stroke-dasharray="${lengthDesktop}"
                      class="banner-pagination-bullet-progress"
                    />
                  </svg>
                  <svg width="24" height="24" class="banner-pagination-bullet-mobile">
                    <circle
                      r="10.5"
                      cx="12"
                      cy="12"
                      class="banner-pagination-bullet-normal" />
                    <circle
                      r="10.5"
                      cx="12"
                      cy="12"
                      stroke-dasharray="${lengthMobile}"
                      class="banner-pagination-bullet-progress" />
                  </svg>
                </div>
              `;
            },
          },
          on: {
            init: function(){
              var swiper = this;

              autoplayBanner.init(swiper);

              swiper.$el
                .on("mouseenter", function(){
                  autoplayBanner.hover = true;
                  autoplayBanner.pause(swiper);
                })
                .on("mouseleave", function(){
                  autoplayBanner.hover = false;
                  autoplayBanner.start(swiper);
                });

            },
            slideChangeTransitionStart: function(){
              autoplayBanner.stop(this);
              autoplayBanner.resetSvg(this);
              hideTitles(this);
            },
            slideChangeTransitionEnd: function(){
              autoplayBanner.start(this);
              showInOrderTitles(this);
            }
          }
        };

      }

      var swiper;

      if (timeout > 0) {
        setTimeout(function(){
          swiper = new Swiper(self, config);
          $this.swipers.push(swiper);
        }, timeout);
      } else {
        swiper = new Swiper(self, config);
        $this.swipers.push(swiper);
      }
    });

    function showInOrderTitles(swiper) {
      var activeSlide = swiper.slides[swiper.activeIndex];
      var activeElems = [activeSlide.querySelector('.banner-slide__name'), activeSlide.querySelector('.banner-slide__desc'), activeSlide.querySelector('.banner-slide__button')];
      activeElems[0].classList.add('show');
      var iterator = 1, timer = setInterval(() => {
        if (iterator >= activeElems.length - 1) clearInterval(timer);
        var item = activeElems[iterator++];
        item.classList.add('show');
      }, 500);
    }
    function hideTitles(swiper) {
      var notActiveSlides = [].slice.call(swiper.slides).filter((s, idx) => idx !== swiper.activeIndex);
      notActiveSlides.forEach(s => {
        var notActiveElems = [s.querySelector('.banner-slide__name'), s.querySelector('.banner-slide__desc'), s.querySelector('.banner-slide__button')];
        notActiveElems.forEach(e => e.classList.remove('show'));
      })
    };

  },

  swiperVideoGallery: function() {

    var $slider = $(".js-swiper-video");
    if ($slider.length) {

      var classTABLET = 'js-swiper-video_tablet';
      var classMOBILE = 'js-swiper-video_mobile';

      $slider.each(function () {

        var self = $(this);
        var $swiper;
        var $pagin = self.find('.swiper-pagination');
        var $next = self.find('.swiper-button-next-kronos');
        var $prev = self.find('.swiper-button-prev-kronos');

        var firstPerView = 2;
        if (self.hasClass('video-gallery_wide')) {
          firstPerView = 4
        }

        var setting = {
          init: false,
          slidesPerView: firstPerView,
          navigation: {
            nextEl: $next,
            prevEl: $prev,
          }
        };

        var settingTablet = {
          init: false,
          slidesPerView: 1,
          slidesPerColumn: 2,
          navigation: {
            nextEl: $next,
            prevEl: $prev,
          },
        };

        var settingMobile = {
          init: false,
          slidesPerView: 1,
          navigation: {
            nextEl: $next,
            prevEl: $prev,
          },
          pagination: {
            el: $pagin,
            type: 'fraction',
            renderFraction: function (currentClass, totalClass) {
              return 'Видео <span class="' + currentClass + '"></span>' +
                ' из ' +
                '<span class="' + totalClass + '"></span>';
            }
          },
        };

        if (!self.hasClass('video-gallery_mobile')) {

          if (window.innerWidth < 768 && (!self.hasClass(classMOBILE))) {
            self.addClass(classMOBILE);
            $swiper = new Swiper(self, settingMobile);
          }
          else if (window.innerWidth < 1261 && (!self.hasClass(classTABLET))) {
            self.addClass(classTABLET);
            $swiper = new Swiper(self, settingTablet);
          }
          else {
            $swiper = new Swiper(self, setting);
          }

          $swiper.init();

        }

        else {

          if (window.innerWidth < 768 && (!self.hasClass(classMOBILE))) {
            self.addClass(classMOBILE);
            $swiper = new Swiper(self, settingMobile);
            $swiper.init();
          }

        }


        $(window).on('resize', function () {
          if (!self.hasClass('video-gallery_mobile')) {
            if (window.innerWidth < 768 && (!self.hasClass(classMOBILE))) {
              self
                .removeClass(classTABLET)
                .addClass(classMOBILE);
              $swiper.destroy(false, true);
              $swiper = new Swiper(self, settingMobile);
              $swiper.init();
            }
            if (window.innerWidth < 1261 && window.innerWidth > 767 && (!self.hasClass(classTABLET))) {
              self
                .removeClass(classMOBILE)
                .addClass(classTABLET);
              $swiper.destroy(false, true);
              $swiper = new Swiper(self, settingTablet);
              $swiper.init();
            }
            else if (window.innerWidth > 1260 && (self.hasClass(classTABLET) || self.hasClass(classMOBILE))) {
              self
                .removeClass(classTABLET)
                .removeClass(classMOBILE);
              $swiper.destroy(false, true);
              $swiper = new Swiper(self, setting);
              $swiper.init();
            }
          }

          else {
            if (window.innerWidth < 768 && (!self.hasClass(classMOBILE))) {
              self.addClass(classMOBILE);
              $swiper = new Swiper(self, settingMobile);
              $swiper.init();
            }
            else if (window.innerWidth > 767 && (self.hasClass(classMOBILE))) {
              self.removeClass(classMOBILE);
              $swiper.destroy(false, true);
            }
          }

        });

      });
    }
  },

  swiperDocGallery: function(){

    var $slider = $(".js-swiper-docs");
    if ($slider.length) {
      var swiperDoc = new Swiper($slider, {
        autoplay: true,
        loop: true,
        slidesPerView: 'auto',
        disableOnInteraction: false,
        slideToClickedSlide: true,
      });
    }
  },

  lang: function() {

    $(document).on("click", ".lang a[data-lang]", function(e){
      e.preventDefault();
      var self = $(this);
      var siblings = self.siblings();
      var parent = self.parent();
      var root = self.closest(".lang");
      var currentLang = root.attr("data-lang");
      var lang = self.attr("data-lang");

      if (currentLang !== lang) {
        var flagCurrent = $(".lang__current", root);
        var flagImage = $(".lang__flag", self);

        flagCurrent.html(flagImage.html());

        root.attr("data-lang", lang);
        siblings.removeClass("active");
        self.addClass("active");
        parent.prepend(self);

        root.trigger("changeLang", {
          lang: lang
        });
      }
    });

  },

  menu: function(){

    $(document).on("mouseenter", ".menu__drop a", function(){
      var self = $(this);
      var root = self.closest(".menu__drop");
      var bg = $(".menu__drop-bg", root);
      var image = self.attr("data-image");

      bg.css({
        backgroundImage: "url("+ image +")"
      });

    });

    $(document).on("mouseenter", ".menu-drop-item", function(){
      var img = $("img[data-src]", this);
      img.each(function(){
        $(this).attr("src", $(this).attr("data-src"));
      });
    });

  },

  tabs: function(){

    $(document).on("click", ".js-close-tab", function(e){
      e.preventDefault();
      var self = $(this);
      var root = self.closest(".tabs-container");
      var tabs = $(".js-tab");

      tabs.removeClass("open");
      root.removeClass("tabs-container_open");
    });

    $(document).on("click", ".js-tab", function(e){
      e.preventDefault();

      var self = $(this);
      var href = self.attr("href");
      var hrefElement = $(href);
      var hrefElementRoot = hrefElement.closest(".tabs-container");
      var tabs = $(".js-tab", self.closest(".tabs"));

      tabs.removeClass("active").removeClass("open");
      self.addClass("active").addClass("open");

      $(".js-tab-container", hrefElementRoot).removeClass("active");
      hrefElement.addClass("active");

      hrefElementRoot.addClass("tabs-container_open");
    });

  },

  customScroll: function(){
    var customScrollElementY = $(".js-custom-scroll-y");
    if (customScrollElementY.length) {
      customScrollElementY.mCustomScrollbar({
        theme: "kronos",
        scrollInertia: 0,
        axis: "y"
      });
    }
  },

  detailGallery: function(){

    var $this = this;
    var paginationActive = $(".detail-gallery-pagination__active");
    var paginationCount = $(".detail-gallery-pagination__count");
    var thumb = $('.detail-gallery-thumbs');
    var detail = $('.detail-gallery');

    if (!thumb.length || !detail.length) {
      return;
    }

    function paginationChange(swiper){
      paginationActive.text(swiper.activeIndex + 1);
      paginationCount.text(swiper.slides.length);
    }

    var mySwiperThumbs = new Swiper (thumb, {
      slidesPerView: 5,
      preloadImages: false,
      lazy: true,
      centeredSlides: true,
      slideToClickedSlide: true
    });

    var mySwiper = new Swiper ('.detail-gallery', {
      preloadImages: false,
      lazy: true,

      // Navigation arrows
      navigation: {
        nextEl: '.detail-gallery .swiper-button-next-kronos',
        prevEl: '.detail-gallery .swiper-button-prev-kronos',
      },

      on: {
        init: function(){
          paginationChange(this);
        },
        slideChange: function(){
          paginationChange(this);
        },
        lazyImageReady: function(slideEl, imageEl){
          var image = $(imageEl);
          if (image.hasClass("cloudzoom-image")) {
            $this.cloudZoom(image , {
              zoomPosition: "inside",
              autoInside: true
            });
          }
        }
      }
    });

    mySwiper.controller.control = mySwiperThumbs;
    mySwiperThumbs.controller.control = mySwiper;

    var detailBannerSwiper = new Swiper ('.detail-banner', {
      preloadImages: false,
      lazy: true,

      // Navigation arrows
      navigation: {
        nextEl: '.detail-banner .swiper-button-next-kronos',
        prevEl: '.detail-banner .swiper-button-prev-kronos',
      }
    });


    var detailSertSwiper = new Swiper ('.detail-sert', {
      preloadImages: false,
      lazy: true,
      direction: "vertical",
      slidesPerView: 3,
      spaceBetween: 11,

      // Navigation arrows
      navigation: {
        nextEl: '.detail-sert .swiper-button-next-kronos',
        prevEl: '.detail-sert .swiper-button-prev-kronos',
      },
    });

    this.swipers.push(
      mySwiper,
      mySwiperThumbs,
      detailBannerSwiper,
      detailSertSwiper
    );
  },

  fileInput: function() {
    var $input = $('.input-file__input');
    if ($input.length) {
      $input.each( function() {

        var $inputSelf = $( this );
        var $label = $inputSelf.next('label');
        var labelVal = $label.html();

        $inputSelf.on('change', function(e) {
          var fileName = '';
          var self=$(this);

          if (self.files && self.files.length > 1) {
            fileName = (self.getAttribute('data-multiple-caption') || '').replace('{count}', self.files.length);
          }
          else if (e.target.value) {
            fileName = e.target.value.split( '\\' ).pop();
          }

          if (fileName) {
            $label.find('span').html(fileName);
          }
          else {
            $label.html(labelVal);
          }
        });

        // Firefox bug fix
        $inputSelf
          .on( 'focus', function(){ $inputSelf.addClass( 'has-focus' ); })
          .on( 'blur', function(){ $inputSelf.removeClass( 'has-focus' ); });
      });
    }
  },

  factsTurn: function () {
    $(document).on("click", ".js-facts-btn, .facts.close .facts-label", function(e){
      e.preventDefault();

      var self = $(this);
      var $block = self.parents('.facts');
      var $list = $block.find('.facts__list');

      if (!$block.hasClass('close')) {
        $list.slideUp({
          start: function(){
            $block.addClass("close");
          }
        });
      }
      else {
        $list.slideDown({
          complete: function(){
            $block.removeClass('close');
          }
        });
      }
    });
  }

};

if (window.svg4everybody) {
  svg4everybody();
}

$(function(){
  App.init();

  $(window)
    .on("load.App", function(){
      App.initOnLoad();
    })
    .on("resize.App", function(){
      App.initOnResize();
    })
});