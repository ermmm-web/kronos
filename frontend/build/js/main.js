"use strict";

function _defineProperty(e, t, n) {
    return t in e ? Object.defineProperty(e, t, {
        value: n,
        enumerable: !0,
        configurable: !0,
        writable: !0
    }) : e[t] = n, e
}
var consoleTrace = function() {
        window.console && console.trace && console.trace.apply(console, arguments)
    },
    breakpoint = {
        ph: 0,
        phx: 576,
        tb: 768,
        tbx: 960,
        lt: 1260,
        dt: 1440,
        dtx: 1700,
        dt2x: 1900
    },
    App = {
        swipers: [],
        transitionNameEvent: function() {
            var e, t = document.createElement("div"),
                n = {
                    transition: "transitionend",
                    oTransition: "oTransitionEnd",
                    mozTransition: "transitionend",
                    webkitTransition: "webkitTransitionEnd"
                };
            for (var a in n)
                if (void 0 !== t.style[a]) {
                    e = n[a];
                    break
                } return void 0 === e && (e = !1), e
        }(),
        init: function() {
            $(".banner__slider").length && $("body").addClass("anim-mobile-header"), this.nav(), this.seo(), this.lang(), this.tabs(), this.menu(), this.header(), this.headerMobile(), this.filter(), this.social(), this.search(), this.countUp(), this.bannerProduct(), this.productBannerInit(), this.popupDownloadCatalog(), this.pagination(), this.detailGallery(), this.customScroll(), this.swiper(".swiper-container.js-swiper", "body"), this.swiperVideoGallery(), this.swiperDocGallery(), this.swiperTriggersScroll(), this.contentPopup(), this.magnificPopup(), this.pointAnimation(), this.logoAnimation(), this.accordion(), this.fileInput(), this.factsTurn(), this.dotdotdot(), this.tooltipster(), this.removePlaceholder(), this.elasticBorderInit(), this.mask.phone.init(), this.swiperSyncAutoplay(), this.bannerDownload()
        },
        initOnLoad: function() {
            this.breadcrumbs()
        },
        initOnResize: function() {
            this.pagination(), this.dotdotdot()
        },
        removePlaceholder: function() {
            $(".js-remove-placeholder").on("focus", function() {
                var e = $(this);
                if (void 0 === e.data("removePlaceholder")) {
                    var t = e.attr("placeholder");
                    e.data("removePlaceholder", t)
                }
                e.attr("placeholder", "")
            }).on("blur", function() {
                var e = $(this),
                    t = e.data("removePlaceholder");
                t && e.attr("placeholder", t)
            })
        },
        productBannerInit: function() {
            this.product(), this.product({
                item: ".banner-product-open",
                image: ".banner-product-open__image",
                imageTarget: ".banner-product-open__image-target",
                imagePreload: ".banner-product-open__image-preload",
                imageOpen: "banner-product-open__image_open"
            })
        },
        search: function() {
            var e = $(".search");
            e.each(function() {
                var t = $(this),
                    e = $("input.search-query", t);
                if (e.off("keyup.search").on("keyup.search", function(e) {
                        0 === $(this).val().length ? t.removeClass("search_fill") : t.addClass("search_fill")
                    }), t.hasClass("search_test")) {
                    var n = $(".search__result", t),
                        a = $(".search__no-result", t);
                    e.off("keyup.searchTest").on("keyup.searchTest", function(e) {
                        var t = $(this).val();
                        0 === t.length ? (n.hide(), a.hide()) : t.length < 3 ? (n.hide(), a.show()) : (n.show(), a.hide())
                    })
                }
            }), $(document).on("click.search", function(e) {
                var t = $(e.target);
                t.closest(".search").length || t.closest(".js-search").length || $(".search").removeClass("search_open")
            }).on("click.search", ".js-search", function(e) {
                e.preventDefault();
                var t = $(this).next(".search");
                if (t.length)
                    if (t.hasClass("search_open")) t.removeClass("search_open");
                    else {
                        t.addClass("search_open");
                        var n = $("input.search-query", t);
                        setTimeout(function() {
                            n.focus()
                        }, 50)
                    }
            }).on("click.search", ".js-search-close", function(e) {
                e.preventDefault();
                var t = $(this).closest(".search");
                t.length && t.removeClass("search_open")
            })
        },
        elasticBorderInit: function() {
            var n = this;
            $(".elastic-border").each(function(e, t) {
                n.elasticBorder($(t))
            })
        },
        elasticBorder: function(s) {
            var a = [],
                i = null,
                o = new function() {
                    this.totalPoints = 6, this.viscosity = 10, this.mouseDist = 100, this.damping = .15, this.showIndicators = !1, this.leftColor = "transparent", this.rightColor = "transparent", this.strokeColor = "#DCDCDC"
                },
                r = 0,
                l = 0,
                t = 0,
                n = 0,
                c = 0,
                d = 0;

            function p(e, t, n) {
                this.x = e, this.ix = e, this.vx = 0, this.cx = 0, this.y = t, this.iy = t, this.cy = 0, this.canvas = n
            }

            function u() {
                var e = s.get(0).getContext("2d");
                i = requestAnimationFrame(u), e.clearRect(0, 0, s.width(), s.height()), e.fillStyle = o.leftColor, e.fillRect(0, 0, s.width(), s.height());
                for (var t = 0; t <= o.totalPoints - 1; t++) a[t].move();
                e.fillStyle = "#ffffff", e.strokeStyle = o.strokeColor, e.lineWidth = 1, e.beginPath(), e.moveTo(s.width() / 2, 0);
                for (t = 0; t <= o.totalPoints - 1; t++) {
                    var n = a[t];
                    null != a[t + 1] ? (n.cx = (n.x + a[t + 1].x) / 2 - 1e-4, n.cy = (n.y + a[t + 1].y) / 2) : (n.cx = n.ix, n.cy = n.iy), e.bezierCurveTo(n.x, n.y, n.cx, n.cy, n.cx, n.cy)
                }
                if (e.fill(), e.stroke(), o.showIndicators) {
                    e.fillStyle = "#000", e.beginPath();
                    for (t = 0; t <= o.totalPoints - 1; t++) {
                        n = a[t];
                        e.rect(n.x - 2, n.y - 2, 4, 4)
                    }
                    e.fill(), e.fillStyle = "#fff", e.beginPath();
                    for (t = 0; t <= o.totalPoints - 1; t++) {
                        n = a[t];
                        e.rect(n.cx - 1, n.cy - 1, 2, 2)
                    }
                    e.fill()
                }
            }
            $(document).on("mousemove", function(e) {
                    var t = e.pageX,
                        n = e.pageY,
                        a = s.offset(),
                        i = t - a.left,
                        o = n - a.top;
                    0 <= i && i <= s.width() && 0 <= o && o <= s.height() ? (c = r < i ? 1 : i < r ? -1 : 0, r = i, l < o ? 1 : o < l ? -1 : 0, l = o) : c = 0
                }),
                function e() {
                    d = r - t, l - n, t = r, n = l, setTimeout(e, 50)
                }(), p.prototype.move = function() {
                    this.vx += (this.ix - this.x) / o.viscosity;
                    var e = this.ix - r,
                        t = this.y - l,
                        n = this.canvas.data("gap");
                    (0 < c && r > this.x || c < 0 && r < this.x) && Math.sqrt(e * e) < o.mouseDist && Math.sqrt(t * t) < n && (this.vx = d / 8), this.vx *= 1 - o.damping, this.x += this.vx
                },
                function() {
                    s.get(0).getContext("2d"), cancelAnimationFrame(i), s.attr("width", s.width()), s.attr("height", s.height()), a = [];
                    for (var e = s.height() / (o.totalPoints - 1), t = s.width() / 2, n = 0; n <= o.totalPoints - 1; n++) a.push(new p(t, n * e, s));
                    u(), s.data("gap", e)
                }()
        },
        popupCalcPrice: {
            naves: function(e) {
                var t, n = $(".popup-calc-price-naves-swiper", e || "body"),
                    a = 40;
                window.innerWidth < breakpoint.lt && (a = 40), window.innerWidth < breakpoint.tbx && (a = 20), new Swiper(n, {
                    slidesPerView: 3,
                    spaceBetween: a,
                    pagination: {
                        el: $(".swiper-pagination-kronos", n.parent()),
                        type: "custom",
                        clickable: !0,
                        renderCustom: function(e, t, n) {
                            return "Оборудование <span>" + t + "</span> из " + n
                        }
                    },
                    navigation: {
                        nextEl: $(".swiper-button-next-2", n.parent()),
                        prevEl: $(".swiper-button-prev-2", n.parent())
                    },
                    breakpoints: (t = {}, _defineProperty(t, breakpoint.tbx - 1, {
                        slidesPerView: 6
                    }), _defineProperty(t, 850, {
                        slidesPerView: 5
                    }), _defineProperty(t, 750, {
                        slidesPerView: 4
                    }), _defineProperty(t, 600, {
                        slidesPerView: 3
                    }), _defineProperty(t, 450, {
                        slidesPerView: 2
                    }), t)
                })
            },
            engine: function(e) {
                var t, n = $(".popup-calc-price-engine-swiper", e || "body"),
                    a = 40;
                window.innerWidth < breakpoint.lt && (a = 60), window.innerWidth < breakpoint.tbx && (a = 20), new Swiper(n, {
                    slidesPerView: 3,
                    spaceBetween: a,
                    pagination: {
                        el: $(".swiper-pagination-kronos", n.parent()),
                        type: "custom",
                        clickable: !0,
                        renderCustom: function(e, t, n) {
                            return "Двигатель <span>" + t + "</span> из " + n
                        }
                    },
                    navigation: {
                        nextEl: $(".swiper-button-next-2", n.parent()),
                        prevEl: $(".swiper-button-prev-2", n.parent())
                    },
                    breakpoints: (t = {}, _defineProperty(t, breakpoint.tbx - 1, {
                        slidesPerView: 6
                    }), _defineProperty(t, 850, {
                        slidesPerView: 5
                    }), _defineProperty(t, 750, {
                        slidesPerView: 4
                    }), _defineProperty(t, 600, {
                        slidesPerView: 3
                    }), _defineProperty(t, 450, {
                        slidesPerView: 2
                    }), t)
                })
            }
        },
        popupDownloadCatalog: function() {
            $(document).on("click", ".js-next-step-download-catalog-popup", function(e) {
                e.preventDefault(), $(this).closest(".popup").addClass("popup-download-catalog_step2")
            })
        },
        popupAnimate: function(e) {
            setTimeout(function() {
                $(e).each(function() {
                    var e = $(this);
                    if (e.hasClass("popup-animate-close-top")) {
                        var t = e.attr("data-delay-close"),
                            n = $(".mfp-close", e);
                        t && n.css({
                            animationDelay: t
                        })
                    }
                    e.addClass("show")
                }), $(".popup-animate-scale, .popup-animate-left, .popup-animate-right, .popup-animate-top", e || "body").each(function() {
                    var e = $(this),
                        t = e.attr("data-delay");
                    t && e.css({
                        transitionDelay: t
                    }), e.addClass("show")
                })
            }, 0)
        },
        mask: {
            phone: {
                arm: function() {
                    return {
                        start: 4,
                        config: function() {
                            var n = this;
                            return {
                                kronosPlaceholder: "+374 __ __-__-___",
                                clearIncomplete: !1,
                                mask: "+374 99 99-99-999",
                                placeholder: "_",
                                oncomplete: function() {
                                    var e = $(this),
                                        t = e.val();
                                    n.check(t) ? e.css("border-color", "") : (e.css("border-color", "red"), e.val("").inputmask("remove"), setTimeout(function() {
                                        e.inputmask(n.config())
                                    }, 0))
                                }
                            }
                        },
                        check: function(e) {
                            return !0
                        }
                    }
                },
                ky: function() {
                    return {
                        start: 4,
                        config: function() {
                            var n = this;
                            return {
                                kronosPlaceholder: "+996 __ __-__-___",
                                clearIncomplete: !1,
                                mask: "+\\9\\96 99 99-99-999",
                                placeholder: "_",
                                oncomplete: function() {
                                    var e = $(this),
                                        t = e.val();
                                    n.check(t) ? e.css("border-color", "") : (e.css("border-color", "red"), e.val("").inputmask("remove"), setTimeout(function() {
                                        e.inputmask(n.config())
                                    }, 0))
                                }
                            }
                        },
                        check: function(e) {
                            return !0
                        }
                    }
                },
                kz: function() {
                    return {
                        start: 2,
                        config: function() {
                            var n = this;
                            return {
                                kronosPlaceholder: "+7 ___ ___-__-__",
                                clearIncomplete: !1,
                                mask: "+7 999 999-99-99",
                                placeholder: "_",
                                oncomplete: function() {
                                    var e = $(this),
                                        t = e.val();
                                    n.check(t) ? e.css("border-color", "") : (e.css("border-color", "red"), e.val("").inputmask("remove"), setTimeout(function() {
                                        e.inputmask(n.config())
                                    }, 0))
                                }
                            }
                        },
                        check: function(e) {
                            var t = !0;
                            switch (e = (e = e.replace(/[^0-9+]/gi, "")).slice(this.start)) {
                                case "0000000000":
                                case "1111111111":
                                case "2222222222":
                                case "3333333333":
                                case "4444444444":
                                case "5555555555":
                                case "6666666666":
                                case "7777777777":
                                case "8888888888":
                                case "9999999999":
                                    t = !1;
                                    break;
                                default:
                                    switch (e.slice(0, 3)) {
                                        case "000":
                                            t = !1
                                    }
                            }
                            return 10 !== e.length && (t = !1), t
                        }
                    }
                },
                ru: function() {
                    return {
                        start: 2,
                        config: function() {
                            var n = this;
                            return {
                                kronosPlaceholder: "+7 ___ ___-__-__",
                                clearIncomplete: !1,
                                mask: "+7 999 999-99-99",
                                placeholder: "_",
                                oncomplete: function() {
                                    var e = $(this),
                                        t = e.val();
                                    n.check(t) ? e.css("border-color", "") : (e.css("border-color", "red"), e.val("").inputmask("remove"), setTimeout(function() {
                                        e.inputmask(n.config())
                                    }, 0))
                                }
                            }
                        },
                        check: function(e) {
                            var t = !0;
                            switch (e = (e = e.replace(/[^0-9+]/gi, "")).slice(this.start)) {
                                case "0000000000":
                                case "1111111111":
                                case "2222222222":
                                case "3333333333":
                                case "4444444444":
                                case "5555555555":
                                case "6666666666":
                                case "7777777777":
                                case "8888888888":
                                case "9999999999":
                                    t = !1;
                                    break;
                                default:
                                    switch (e.slice(0, 3)) {
                                        case "000":
                                            t = !1
                                    }
                            }
                            return 10 !== e.length && (t = !1), t
                        }
                    }
                },
                by: function() {
                    return {
                        start: 4,
                        config: function() {
                            var n = this;
                            return {
                                kronosPlaceholder: "+375 __ __-__-___",
                                clearIncomplete: !1,
                                mask: "+375 99 99-99-999",
                                placeholder: "_",
                                oncomplete: function() {
                                    var e = $(this),
                                        t = e.val();
                                    n.check(t) ? e.css("border-color", "") : (e.css("border-color", "red"), e.val("").inputmask("remove"), setTimeout(function() {
                                        e.inputmask(n.config())
                                    }, 0))
                                }
                            }
                        },
                        check: function(e) {
                            var t = !0;
                            switch (e = (e = e.replace(/[^0-9+]/gi, "")).slice(this.start)) {
                                case "000000000":
                                case "111111111":
                                case "222222222":
                                case "333333333":
                                case "444444444":
                                case "555555555":
                                case "666666666":
                                case "777777777":
                                case "888888888":
                                case "999999999":
                                    t = !1
                            }
                            switch (e.slice(2)) {
                                case "0000000":
                                case "1111111":
                                case "2222222":
                                case "3333333":
                                case "4444444":
                                case "5555555":
                                case "6666666":
                                case "7777777":
                                case "8888888":
                                case "9999999":
                                    t = !1
                            }
                            var n = e.slice(0, 2);
                            return -1 === ["29", "44", "33", "25", "16", "17", "15", "21", "22", "23"].indexOf(n) && (t = !1), 9 !== e.length && (t = !1), t
                        }
                    }
                },
                init: function(e, t) {
                    var p = this;
                    $(".input-phone", e || "body").each(function() {
                        var a = $(this),
                            i = a.attr("data-lang"),
                            o = p[i || "by"](),
                            s = o.config(),
                            r = $(".input-phone__input input", a),
                            e = $(".input-phone__placeholder", a),
                            l = $(".input-phone__code", e),
                            c = $(".input-phone__phone", e);
                        s.kronosPlaceholder && r.attr("placeholder", s.kronosPlaceholder);
                        var d = function() {
                            var e = r.val();
                            e.length || (e = s.kronosPlaceholder);
                            var t, n, a = e.indexOf(s.placeholder);
                            n = 0 <= a ? (t = e.slice(0, a), e.slice(a)) : (t = e, ""), l.html(t), c.html(n)
                        };
                        a.off("changeLang").on("changeLang", function(e, t) {
                            var n = t.lang;
                            n && (a.attr("data-lang", n), r.inputmask("remove"), r.val(""), o = p[(i = n) || "by"](), s = o.config(), d())
                        }), e.off("focus").on("focus", function(e) {
                            a.addClass("hide_placeholder"), r.focus(), r.data("_inputmask_opts") || r.inputmask($.extend(s, t || {}, {
                                clearMaskOnLostFocus: !1
                            }))
                        }), r.off("focus").off("blur").on("blur", function(e) {
                            d(), a.removeClass("hide_placeholder")
                        })
                    })
                }
            }
        },
        tooltipster: function() {
            $(".js-tooltip").each(function() {
                var e = $(this),
                    p = $(".js-tooltip-target", e);
                e.tooltipster({
                    animationDuration: 0,
                    delay: 0,
                    theme: ["tooltipster-kronos"],
                    functionPosition: function(e, t, n) {
                        var a, i, o, s = $(t.origin),
                            r = s.attr("data-position-x"),
                            l = s.attr("data-offset-x"),
                            c = s.attr("data-offset-y"),
                            d = [];
                        if (a = p.length ? p.offset() : s.offset(), r && (d = r.split(";")), d.length) switch (d[0]) {
                            case "left":
                                if (n.coord.left = a.left, "string" == typeof d[1] && 1 < d[1].length) switch (i = d[1].charAt(0), o = +d[1].slice(1) || 0, i) {
                                    case "+":
                                        n.coord.left += o;
                                        break;
                                    case "-":
                                        n.coord.left -= o
                                }
                        }
                        if ("string" == typeof c && 1 < c.length) switch (i = c.charAt(0), o = +c.slice(1) || 0, i) {
                            case "+":
                                n.coord.top += o;
                                break;
                            case "-":
                                n.coord.top -= o
                        }
                        if ("string" == typeof l && 1 < l.length) switch (i = l.charAt(0), o = +l.slice(1) || 0, i) {
                            case "+":
                                n.coord.left += o;
                                break;
                            case "-":
                                n.coord.left -= o
                        }
                        return n
                    }
                })
            })
        },
        dotdotdot: function(e) {
            $(".js-dotdotdot", e || "body").each(function() {
                var e = $(this);
                if (!e.data("dotdotdot")) {
                    var t = e.height(),
                        n = e.data("config-dotdotdot") || {},
                        a = $.extend({
                            truncate: "letter",
                            height: Math.ceil(t),
                            watch: !0,
                            callback: function(e) {}
                        }, n);
                    e.dotdotdot(a)
                }
            })
        },
        cloudZoom: function(e, t) {
            t = t || {}, e.length && e.CloudZoom(t)
        },
        social: function() {
            $(document).on("click", ".js-toggle-social", function(e) {
                e.preventDefault(), $(this).closest(".social").toggleClass("social_open")
            })
        },
        breadcrumbs: function() {
            var e = $(window);

            function t() {
                var n = e.scrollTop(),
                    a = n + e.height();
                $(".breadcrumbs").each(function() {
                    var e = $(this);
                    if (!e.hasClass("breadcrumbs_animate")) {
                        var t = e.offset().top;
                        n <= t && a >= t + e.height() && (console.log(n), e.addClass("breadcrumbs_animate"))
                    }
                })
            }
            t(), e.on("scroll", function() {
                t()
            })
        },
        seo: function() {
            $(document).on("click", ".js-seo-toggle", function(e) {
                var t, n = $(this);
                t = n.hasClass("dot-link-one-line") ? $("span", n) : n;
                var a = n.attr("data-show"),
                    i = n.attr("data-hide"),
                    o = n.closest(".seo"),
                    s = $(".seo__slide", o);
                s.is(":visible") ? (t.html(a), s.slideUp(), n.hasClass("dot-link-one-line") ? n.find(".dot-link-one-line__name").removeClass("dot-link-one-line__name-active") : n.removeClass("btn_reverse")) : (t.html(i), s.slideDown(), n.hasClass("dot-link-one-line") ? n.find(".dot-link-one-line__name").addClass("dot-link-one-line__name-active") : n.addClass("btn_reverse"))
            })
        },
        pagination: function(s) {
            s = void 0 !== s && s;
            var r = this;
            $(".js-pagination").each(function() {
                var e, t, n, a = $(this),
                    i = a.width() + a.offset().left,
                    o = $(".pagination__list > ul", a);
                i < o.width() + o.offset().left && (e = (n = $(".pagination__item_active", a)).prevAll(".pagination__item:visible"), t = n.nextAll(".pagination__item:visible"), e.length > t.length ? e.eq(e.length - 1).hide() : t.eq(t.length - 1).hide(), s || r.pagination())
            })
        },
        countUp: function() {
            $(".js-countUp").each(function() {
                var e = $(this),
                    t = e.attr("data-start"),
                    n = e.attr("data-end"),
                    a = e.attr("data-suffix"),
                    i = e.attr("data-duration"),
                    o = {
                        separator: "",
                        suffix: "",
                        duration: 4
                    };
                t && (o.startVal = +t), a && (o.suffix = a), +i && (o.duration = +i);
                var s = new CountUp(this, +n, o);
                e.data("countUp", s)
            }), $(window).on("scroll", function() {
                var s = $(this),
                    r = s.scrollTop();
                $(".js-countUp").each(function() {
                    var e = $(this),
                        t = e.data("countUp");
                    if (t && t.paused) {
                        var n = e.attr("data-increment"),
                            a = e.attr("data-increment-delay"),
                            i = e.offset(),
                            o = e.height();
                        i.top >= r && i.top + o <= r + s.height() && (t.error ? console.error(t.error) : t.start(function() {
                            n && a && setTimeout(function() {
                                t.update(t.endVal + +n)
                            }, +a)
                        }))
                    }
                })
            }).trigger("scroll")
        },
        bannerProduct: function() {
            var d = $(window),
                s = $("body"),
                a = this,
                i = {
                    data: [],
                    isGallery: function(e) {
                        return this.getGallery(e).length
                    },
                    getGallery: function(e) {
                        return e.closest(".banner-products-swiper")
                    },
                    getData: function(e) {
                        return e.data("banner")
                    },
                    add: function(e) {
                        if (!e.data("banner")) {
                            var t = {
                                self: e
                            };
                            e.data("banner", t), this.data.push(t)
                        }
                    },
                    hide: function(e) {
                        var t = e.data("banner");
                        t.open && (e.trigger("banner-hide", this), t.open.removeClass("banner-product-open_open"))
                    },
                    hideAll: function() {
                        var n = this;
                        this.data.forEach(function(e) {
                            var t = e.self;
                            n.hide(t)
                        })
                    },
                    show: function(e, t, n) {
                        var a, i = this,
                            o = e.data("banner");
                        o.open ? a = o.open : (a = $(".banner-product-open", e), o.open = a), a.off("mouseenter").on("mouseenter", function() {
                            o.mouseenter = !0
                        }), a.off("mouseleave").on("mouseleave", function() {
                            n && n(a), i.hide(e)
                        }), this.setPosition(e), s.append(a), setTimeout(function() {
                            t && t(a), a.addClass("banner-product-open_open"), e.trigger("banner-open", i)
                        }, 0)
                    },
                    setPositionAll: function() {
                        var n = this;
                        this.data.forEach(function(e) {
                            var t = e.self;
                            n.setPosition(t)
                        })
                    },
                    setPosition: function(c) {
                        setTimeout(function() {
                            var e, t = c.data("banner");
                            e = t.open ? t.open : $(".banner-product-open", c);
                            var n = c.outerWidth(),
                                a = c.offset(),
                                i = d.width(),
                                o = e.outerWidth(),
                                s = a.left,
                                r = a.top - 1,
                                l = {};
                            i <= s + o ? (l.right = i - (s + n) - 1, l.left = "auto") : (l.right = "auto", l.left = s - 1), t.open.css($.extend({
                                position: "absolute",
                                top: r,
                                zIndex: 2001,
                                minHeight: "0"
                            }, l))
                        }, 0)
                    }
                };
            d.on("resize", function() {
                i.setPositionAll()
            }), $(document).on("mouseleave", ".banner-product", function(e) {
                var t = $(this).data("timer");
                t && clearTimeout(t)
            }).on("mouseenter", ".banner-product", function(e) {
                var t = $(this),
                    n = setTimeout(function() {
                        var e = !0;
                        i.isGallery(t) && (i.getGallery(t).data("swiper").animating && (e = !1));
                        e && (a.productBannerInit(), i.hideAll(), i.add(t), i.show(t, function(e) {
                            $(".js-banner-product-countUp", e).each(function() {
                                var e = $(this),
                                    t = e.attr("data-start"),
                                    n = e.attr("data-end");
                                if (!e.data("countUp") && "string" == typeof t && "string" == typeof n) {
                                    var a = new CountUp(this, +n.replace(/[^0-9]/g, ""), {
                                        separator: " ",
                                        suffix: " р.",
                                        duration: 4
                                    });
                                    a.error ? console.error(a.error) : e.data("countUpTimer", setTimeout(function() {
                                        e.data("countUp", !0), a.start()
                                    }, 500))
                                }
                            })
                        }, function(e) {
                            $(".js-banner-product-countUp", e).each(function() {
                                var e = $(this).data("countUpTimer");
                                e && clearTimeout(e)
                            })
                        }))
                    }, 200);
                t.data("timer", n)
            })
        },
        product: function(u) {
            var e = 1 < arguments.length && void 0 !== arguments[1] ? arguments[1] : "body";
            u = $.extend({
                item: ".product",
                image: ".product__image",
                imageTarget: ".product__image-target",
                imagePreload: ".product__image-preload",
                imageOpen: "product__image_open",
                preloadShow: "show",
                pagination: ".pagination-line a",
                paginationActive: "active"
            }, u);
            var t = $(u.item, e);
            if (t.length) {
                var h = {
                    show: function(e) {
                        e.addClass(u.preloadShow)
                    },
                    hide: function(e) {
                        e.removeClass(u.preloadShow)
                    },
                    open: function(e, t, n, a) {
                        var i, o = this,
                            s = e.siblings(),
                            r = e.attr("href");
                        e.data("loadedImage") ? ((i = new Image).src = r, n.html(i), s.removeClass(u.paginationActive), e.addClass(u.paginationActive), a && a()) : (this.show(t), (i = new Image).onerror = function() {
                            consoleTrace("Ошибка загрузки изображения."), o.hide(t)
                        }, i.onload = function() {
                            n.html(i), o.hide(t), s.removeClass(u.paginationActive), e.addClass(u.paginationActive), e.data("loadedImage", !0), a && a()
                        }, i.src = r)
                    }
                };
                t.each(function() {
                    var e = $(this);
                    if (!e.data("product")) {
                        e.data("product", !0);
                        var l = $(u.image, e),
                            c = $(u.imageTarget, e),
                            d = $(u.imagePreload, e),
                            p = $(u.pagination, e);
                        l.on("mouseleave", function(e) {
                            var t = $(this);
                            t.hasClass(u.imageOpen) && t.removeClass(u.imageOpen)
                        }), l.on("mousemove", function(e) {
                            var t = $(this),
                                n = t.attr("data-count"),
                                a = t.attr("data-position");
                            if (n) {
                                var i = t.offset(),
                                    o = t.width(),
                                    s = e.clientX - i.left,
                                    r = Math.ceil(s / o * n);
                                r < 1 ? r = 1 : n < r && (r = n), r != a && h.open(p.eq(r - 1), d, c, function() {
                                    l.attr("data-position", r)
                                }), r == n ? t.hasClass(u.imageOpen) || t.addClass(u.imageOpen) : t.hasClass(u.imageOpen) && t.removeClass(u.imageOpen)
                            }
                        }), e.on("click", u.pagination, function(e) {
                            e.preventDefault();
                            var t = $(this),
                                n = t.index();
                            h.open(t, d, c, function() {
                                l.attr("data-position", n + 1)
                            })
                        })
                    }
                })
            }
        },
        filter: function() {
            $(".js-filter-root").each(function() {
                var e = $(this),
                    t = $("input.check-cust:checked", e),
                    n = $(".filter__count", e);
                e[t.length ? "addClass" : "removeClass"]("filtered"), n.html(t.length ? t.length : "&nbsp;")
            })
        },
        accordion: function() {
            $(document).on("click", ".accordion__close", function(e) {
                var t = $(this),
                    n = t.parents(".accordion__body"),
                    a = t.parents(".accordion__item");
                n.fadeOut({
                    complete: function() {
                        a.removeClass("active")
                    }
                }), $("body").removeClass("accordion-popup-active")
            }), $(document).on("click", ".accordion__head", function(e) {
                var t = $(this),
                    n = t.parents(".accordion__item"),
                    a = t.next(".accordion__body");
                t.parents(".accordion_mobile-popup").length && window.innerWidth < breakpoint.tb || t.parents(".accordion-tablet").length && t.parents(".accordion_mobile-popup").length && window.innerWidth < breakpoint.tbx ? n.hasClass("active") || ($("body").addClass("accordion-popup-active"), a.fadeIn({
                    start: function() {
                        n.addClass("active")
                    }
                })) : n.hasClass("active") ? a.slideUp({
                    start: function() {
                        n.removeClass("active")
                    }
                }) : ($(".accordion__item").each(function() {
                    var e = $(this);
                    e.hasClass("active") && e.find(".accordion__body").slideUp({
                        start: function() {
                            e.removeClass("active")
                        }
                    })
                }), a.slideDown({
                    start: function() {
                        n.addClass("active")
                    }
                }))
            }), $(document).on("click", ".faq__btn .btn", function(e) {
                e.preventDefault();
                var t = $(this),
                    n = t.closest(".faq"),
                    a = $(".accordion__accordion", n);
                a.is(":hidden") ? (t.addClass("btn_reverse"), t.text("Свернуть вопросы"), a.slideDown()) : (t.removeClass("btn_reverse"), t.text("Все вопросы"), a.slideUp())
            })
        },
        nav: function() {
            $(document).on("click", ".nav-drop > a", function(e) {
                e.preventDefault();
                var t = $(this),
                    n = t.parent(),
                    a = t.next(".nav__ul");
                a.is(":hidden") ? a.slideDown({
                    start: function() {
                        n.addClass("nav-open")
                    }
                }) : a.slideUp({
                    complete: function() {
                        n.removeClass("nav-open")
                    }
                })
            })
        },
        triggers: function(s) {
            $(window);
            var r = $("body"),
                e = $(s.$el),
                a = {
                    data: [],
                    isVisible: function(e) {
                        var t = e.data("trigger");
                        if (t) {
                            var n = t.open;
                            if (n && n.hasClass("animated-blobs")) return !0
                        }
                        return !1
                    },
                    add: function(e) {
                        if (!e.data("trigger")) {
                            var t = {
                                self: e
                            };
                            e.data("trigger", t), this.data.push(t)
                        }
                    },
                    hide: function(e) {
                        this.timer && clearTimeout(this.timer);
                        var t = e.data("trigger");
                        t.mouseenter = !1, t.open && (e.trigger("trigger-hide", s), t.open.removeClass("animated-blobs"))
                    },
                    hideAll: function() {
                        var n = this;
                        this.data.forEach(function(e) {
                            var t = e.self;
                            n.hide(t)
                        })
                    },
                    show: function(e, t, n) {
                        var a = this;
                        this.timer && clearTimeout(this.timer);
                        var i, o = e.data("trigger");
                        o.open ? i = o.open : (i = $(".trigger-item__js", e), o.open = i), i.off("mouseenter").on("mouseenter", function() {
                            o.mouseenter = !0, console.log("enter")
                        }), i.off("mouseleave").on("mouseleave", function() {
                            n && n(i), a.hide(e)
                        }), this.setPosition(e), i.parent().is("body") || r.append(i), this.timer = setTimeout(function() {
                            t && t(i), e.trigger("trigger-open", s), i.addClass("animated-blobs")
                        }, 0)
                    },
                    setPositionAll: function() {
                        var n = this;
                        this.data.forEach(function(e) {
                            var t = e.self;
                            n.setPosition(t)
                        })
                    },
                    setPosition: function(r) {
                        setTimeout(function() {
                            var e, t = r.data("trigger");
                            e = t.open ? t.open : $(".trigger-item__js", r);
                            var n = r.outerWidth(),
                                a = r.outerHeight(),
                                i = r.offset(),
                                o = i.left,
                                s = i.top;
                            e.css($.extend({
                                position: "absolute",
                                top: s,
                                zIndex: 2001,
                                minHeight: "0",
                                width: 2 * n,
                                height: a,
                                left: o
                            }, {}))
                        }, 0)
                    }
                };
            e.on("mousemove", ".trigger-item", function(e) {
                var t = $(this),
                    n = !0;
                s && s.animating && (n = !1), n && !a.isVisible(t) && (a.hideAll(), a.add(t), a.show(t))
            }).on("mouseleave", ".trigger-item", function(e) {
                var t = $(this).data("trigger");
                setTimeout(function() {
                    t.mouseenter || a.hideAll()
                }, 0)
            }), e.on("mouseenter", ".swiper-button", function(e) {
                $(this).parents(".triggers-wrap").addClass("triggers-overflow")
            }), e.on("mouseleave", ".swiper-button", function(e) {
                $(this).parents(".triggers-wrap").removeClass("triggers-overflow")
            })
        },
        header: function() {
            var i = $(".header"),
                e = $(".header__desktop");
            if (i.length && e.length && i.is(":visible")) {
                var o = $("body"),
                    s = $(window),
                    r = 0,
                    l = "=";
                s.on("scroll.header", function(e) {
                    var t = s.height(),
                        n = s.scrollTop();
                    0 <= r && (l = r < n ? "down" : n < r ? "up" : "="), 0 < n ? i.hasClass("header_line") || i.addClass("header_line") : i.hasClass("header_line") && i.removeClass("header_line");
                    var a = !o.hasClass("open-header-mob-popup");
                    if (2 * t < n && a) switch (l) {
                        case "up":
                            i.hasClass("header_hide") && i.removeClass("header_hide");
                            break;
                        case "down":
                        default:
                            i.hasClass("header_hide") || i.addClass("header_hide")
                    }
                    r = n
                }).trigger("scroll.header")
            }
        },
        headerPopup: {
            show: function(e) {
                var t = $("body"),
                    n = e.parent(),
                    a = e.attr("href"),
                    i = $(a);
                i.length && (t.hasClass("open-header-mob-popup") ? (t.removeClass("open-header-mob-popup"), n.removeClass("open"), i.removeClass("open")) : (t.addClass("open-header-mob-popup"), n.addClass("open"), i.addClass("open")))
            },
            hide: function() {
                $("body").removeClass("open-header-mob-popup"), $(".menu-mob li").removeClass("open"), $(".menu-mob-popup").removeClass("open")
            }
        },
        headerMobile: function() {
            var t = this;
            $(document).on("click.headerMobile", ".js-toggle-header-popup", function(e) {
                e.preventDefault(), t.headerPopup.show($(e.currentTarget))
            }).on("click.headerMobile", ".js-close-header-popup", function(e) {
                e.preventDefault(), t.headerPopup.hide(e)
            })
        },
        logoAnimation: function() {
            var e, t = this,
                n = $(".header__desktop .logo, .footer-logo"),
                a = "logo_animation",
                i = "footer-logo_animation",
                o = function(e) {
                    e.each(function() {
                        var e = $(this);
                        e.hasClass("logo") ? (e.removeClass(a), setTimeout(function() {
                            e.one(t.transitionNameEvent, function() {
                                e.removeClass(a)
                            }), e.addClass(a)
                        }, 0)) : e.hasClass("footer-logo") && (e.removeClass(i), setTimeout(function() {
                            e.one(t.transitionNameEvent, function() {
                                e.removeClass(i)
                            }), e.addClass(i)
                        }, 0))
                    })
                };
            e = setInterval(function() {
                o(n)
            }, 3e4), $(document).on("mouseenter", ".header__desktop .logo", function() {
                e && clearInterval(e), n.removeClass(a)
            }).on("mouseleave", ".header__desktop .logo", function() {
                e = setInterval(function() {
                    o(n)
                }, 3e4)
            })
        },
        contentPopup: function() {
            var t = this,
                s = $("body"),
                r = $("#popup-content"),
                l = $("#popup-content-body");
            $(document).on("click", ".js-open-content-popup", function(e) {
                e.preventDefault();
                var t = $(this),
                    n = t.attr("data-content"),
                    a = t.attr("data-class");
                if (a = a ? a.split(" ") : [], n) {
                    var i = $(n);
                    if (i.length) {
                        var o = i.html();
                        l.html(o), r.data("popupClassName", a), a.length && a.forEach(function(e) {
                            r.addClass(e)
                        }), s.addClass("popup-content-open"), r.addClass("popup-content_open")
                    }
                }
            }), $(document).on("click", ".js-close-content-popup", function(e) {
                e.preventDefault(), s.removeClass("popup-content-open"), r.removeClass("popup-content_open"), r.one(t.transitionNameEvent, function() {
                    var e = r.data("popupClassName");
                    e && e.length && e.forEach(function(e) {
                        r.removeClass(e)
                    }), r.data("popupClassName", [])
                })
            })
        },
        magnificPopup: function() {
            var o = this;
            $(".popup-modal").magnificPopup({
                callbacks: {
                    open: function() {},
                    close: function() {}
                }
            }), $(".popup-youtube").magnificPopup({
                type: "iframe",
                mainClass: "mfp-fade popup_video-gallery",
                removalDelay: 160,
                preloader: !1,
                closeBtnInside: !1,
                fixedContentPos: !1
            });
            var e = $(".popup-doc");
            e.length && e.each(function() {
                var e = $(this),
                    t = e.attr("href"),
                    n = e.find(".popup-doc-bar__info").html(),
                    a = e.attr("data-doc"),
                    i = t || a;
                e.magnificPopup({
                    items: {
                        src: i
                    },
                    type: "image",
                    mainClass: "popup_image",
                    removalDelay: 160,
                    preloader: !1,
                    closeBtnInside: !1,
                    fixedContentPos: !1,
                    image: {
                        markup: '\n              <div class="mfp-figure">\n                '.concat(n ? '<div class="popup-doc-bar">'.concat(n, "</div>") : "", '\n                <div class="mfp-img"></div>\n              </div>\n            ')
                    }
                })
            });
            var t = $(".js-popup-docs");
            t.length && t.each(function() {
                var t = $(this).find(".js-popup-docs-el"),
                    o = [];
                t.each(function() {
                    var e = $(this),
                        t = e.attr("data-doc"),
                        n = "",
                        a = e.find(".popup-doc-bar__info");
                    a.length && (n = a.html());
                    var i = {
                        src: t,
                        info: n
                    };
                    o.push(i)
                }), t.magnificPopup({
                    allowTouchMove: !1,
                    items: o,
                    type: "image",
                    mainClass: "popup_image",
                    removalDelay: 160,
                    preloader: !1,
                    closeBtnInside: !1,
                    fixedContentPos: !1,
                    image: {
                        markup: '<div class="mfp-figure"><div class="popup-doc-bar"></div><div class="mfp-img"></div></div>'
                    },
                    gallery: {
                        enabled: !0,
                        navigateByImgClick: !0
                    },
                    callbacks: {
                        beforeOpen: function() {
                            var e = t.index(this.st.el); - 1 !== e && this.goTo(e)
                        },
                        markupParse: function(e, t, n) {
                            var a = this.currItem.index;
                            e.find(".popup-doc-bar").html(o[a].info)
                        }
                    }
                })
            });
            var n = $(".video-gallery");
            n.length && n.each(function() {
                var e = $(this),
                    t = "",
                    n = e.find(".video-gallery-info");
                n.length && (t = n.html());
                var a = e.find(".popup-youtube-gallery"),
                    i = [];
                a.each(function() {
                    var e = {
                        src: $(this).attr("href"),
                        type: "iframe"
                    };
                    i.push(e)
                }), a.magnificPopup({
                    items: i,
                    type: "iframe",
                    mainClass: "mfp-fade popup_video-gallery",
                    removalDelay: 160,
                    preloader: !1,
                    closeBtnInside: !1,
                    iframe: {
                        markup: '<div class="mfp-iframe-scaler">' + t + '<iframe class="mfp-iframe" frameborder="0" allowfullscreen></iframe></div>'
                    },
                    fixedContentPos: !1,
                    gallery: {
                        enabled: !0,
                        navigateByImgClick: !0
                    },
                    callbacks: {
                        beforeOpen: function() {
                            var e = a.index(this.st.el); - 1 !== e && this.goTo(e)
                        },
                        open: function() {
                            o.popupAnimate(this.content)
                        }
                    }
                })
            }), $(".popup-modal-ajax").each(function() {
                var e = $(this),
                    t = {
                        type: "ajax",
                        mainClass: "mfp-animation popup-fixed",
                        fixedContentPos: !0,
                        fixedBgPos: !0,
                        callbacks: {
                            open: function() {},
                            close: function() {}
                        }
                    },
                    n = e.attr("data-mfp-mainClass");
                n && (t.mainClass += " ".concat(n)), e.magnificPopup(t)
            })
        },
        pointAnimation: function() {
            $(document).on("mouseenter", ".point-animation", function() {
                var e = $(this);
                e.hasClass("swiper-button-disabled") || (e.removeClass("point-animation"), setTimeout(function() {
                    e.addClass("point-animation")
                }, 0))
            })
        },
        swiper: function(e, t, p) {
            p = p || 0;
            var u, h = this,
                f = function(e, t) {
                    return {
                        el: $(".swiper-pagination-kronos", e),
                        type: "custom",
                        clickable: !0,
                        renderCustom: t || function(e, t, n) {
                            return t + " of " + n
                        }
                    }
                };
            $(e, t).each(function() {
                var t = $(this),
                    e = t.closest(".js-swiper-root");
                e.length || (e = t), t.find(".swiper-slide").length < 2 && t.addClass("no-pagination");
                var n, a = {
                    preloadImages: !0,
                    lazy: !0,
                    navigation: {
                        nextEl: $(".swiper-button-next-kronos", e),
                        prevEl: $(".swiper-button-prev-kronos", e)
                    },
                    pagination: {
                        el: $(".swiper-pagination-kronos", e),
                        type: "bullets",
                        clickable: !0
                    }
                };
                if (t.hasClass("triggers") && !t.closest(".footer__triggers").length && (a = $.extend(a, {
                        loop: !0,
                        noSwiping: !0,
                        noSwipingClass: "swiper-no-swiping",
                        autoplay: {
                            delay: 3e3
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
                            init: function() {
                                var e = this;
                                e.$el.on("mouseenter.swiperAutoplay", function() {
                                    e.autoplay.stop()
                                }).on("mouseleave.swiperAutoplay", function() {
                                    e.autoplay.start()
                                }), h.triggers(e)
                            }
                        }
                    })), t.hasClass("triggers") && t.closest(".footer__triggers").length) {
                    var i = !0,
                        o = !0;
                    a = $.extend(a, {
                        loop: !0,
                        autoplay: {
                            delay: 3e3
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
                            init: function() {
                                h.triggers(this)
                            },
                            slideNextTransitionStart: function() {
                                i && (setTimeout(function() {
                                    return u && u.slideNext()
                                }, 10), i = !1, setTimeout(function() {
                                    return i = !0
                                }, 2900))
                            },
                            slidePrevTransitionStart: function() {
                                o && (setTimeout(function() {
                                    return u && u.slidePrev()
                                }, 10), o = !1, setTimeout(function() {
                                    return o = !0
                                }, 2900))
                            }
                        }
                    })
                } else if (t.hasClass("detail-triggers_scroll"));
                else if (t.hasClass("menu-mob-popup-shop__swiper")) a = $.extend(a, {
                    pagination: f(e, function(e, t, n) {
                        return "Фото <span>" + t + "</span> из " + n
                    })
                });
                else if (t.hasClass("views-products__swiper")) {
                    var s;
                    a = $.extend(a, {
                        slidesPerView: 2,
                        spaceBetween: 16,
                        pagination: f(e, function(e, t, n) {
                            return "Товары <span>" + t + "</span> из " + n
                        }),
                        breakpoints: (s = {}, _defineProperty(s, breakpoint.tbx - 1, {
                            slidesPerView: 4
                        }), _defineProperty(s, 767, {
                            slidesPerView: 3
                        }), _defineProperty(s, 575, {
                            slidesPerView: 2
                        }), s)
                    })
                } else if (t.hasClass("views-products-vertical__swiper")) a = $.extend(a, {
                    direction: "vertical",
                    slidesPerView: 3
                });
                else if (t.hasClass("views-products-horizontal__swiper")) a = $.extend(a, {
                    slidesPerView: 3,
                    pagination: f(e, function(e, t, n) {
                        return "Фото <span>" + t + "</span> из " + n
                    }),
                    breakpoints: {
                        1699: {
                            slidesPerView: 3
                        },
                        950: {
                            slidesPerView: 2
                        },
                        767: {
                            slidesPerView: 3
                        },
                        575: {
                            slidesPerView: 2
                        }
                    }
                });
                else if (t.hasClass("footer__bottom-slider")) a = $.extend(a, {
                    loop: !0,
                    autoplay: {
                        delay: 1e6
                    },
                    pagination: f(e, function(e, t, n) {
                        return "Фото <span>" + t + "</span> из " + n
                    }),
                    on: {
                        init: function() {
                            var e = u = this;
                            e.$el.on("mouseenter.swiperAutoplay", function() {
                                e.autoplay.stop()
                            }).on("mouseleave.swiperAutoplay", function() {
                                e.autoplay.start()
                            })
                        }
                    },
                    breakpoints: {
                        767: {
                            loop: !1
                        }
                    }
                });
                else if (t.hasClass("popup-shop-gallery")) {
                    var r = function() {
                        var e = $(this.slides[this.activeIndex]);
                        if (e.is("[data-name]")) {
                            var t = e.closest(".popup");
                            $(".popup-shop__name", t).html(e.attr("data-name"))
                        }
                    };
                    a = $.extend(a, {
                        pagination: f(e, function(e, t, n) {
                            return "<span>Фотография " + t + " из " + n + "</span>"
                        }),
                        on: {
                            init: r,
                            slideChange: r
                        }
                    })
                } else if (t.hasClass("video-gallery_catalog")) a = $.extend(a, {
                    slidesPerView: 3,
                    breakpoints: {
                        576: {
                            slidesPerView: 1
                        },
                        1260: {
                            slidesPerView: 2
                        }
                    }
                });
                else if (t.hasClass("why-buy__swiper")) a = $.extend(a, {
                    loop: !1,
                    loopAdditionalSlides: 20,
                    slidesPerView: 1,
                    effect: "coverflow",
                    centeredSlides: !1,
                    spaceBetween: 0,
                    coverflowEffect: {
                        rotate: 0,
                        stretch: 160,
                        depth: 500,
                        modifier: 1,
                        slideShadows: !1
                    },
                    pagination: f(e, function(e, t, n) {
                        return "<span>" + t + "</span> из " + n
                    }),
                    on: {
                        init: function() {
                            var a = this,
                                i = $(a.$el),
                                o = $(window);
                            o.on("scroll.whyBuy", function() {
                                var e = o.scrollTop(),
                                    t = o.height(),
                                    n = i.offset();
                                e <= n.top && e + t >= n.top + i.height() && (a.autoplay.start(), i.on("mouseenter.swiperAutoplay", function() {
                                    a.autoplay.stop()
                                }).on("mouseleave.swiperAutoplay", function() {
                                    a.autoplay.start()
                                }), o.off(".whyBuy"))
                            }).trigger("scroll.whyBuy")
                        }
                    },
                    breakpoints: {
                        1e3: {
                            coverflowEffect: {
                                stretch: 600
                            }
                        },
                        900: {
                            coverflowEffect: {
                                stretch: 450
                            }
                        },
                        800: {
                            coverflowEffect: {
                                stretch: 350
                            }
                        },
                        700: {
                            coverflowEffect: {
                                stretch: 300
                            }
                        },
                        600: {
                            coverflowEffect: {
                                stretch: 250
                            }
                        },
                        500: {
                            coverflowEffect: {
                                stretch: 160
                            }
                        },
                        400: {
                            coverflowEffect: {
                                stretch: 100
                            }
                        }
                    }
                });
                else if (t.hasClass("video-gallery_head")) a = $.extend(a, {
                    slidesPerView: 2,
                    breakpoints: {
                        1699: {
                            slidesPerView: 1
                        }
                    }
                });
                else if (t.hasClass("video-gallery_head2")) a = $.extend(a, {
                    loop: !0,
                    slidesPerView: 1,
                    breakpoints: {
                        1699: {
                            slidesPerView: 1
                        }
                    }
                });
                else if (t.hasClass("video-gallery_obzor")) a = $.extend(a, {
                    slidesPerView: 1,
                    pagination: f(e, function(e, t, n) {
                        return "Видео <span>" + t + "</span> из " + n
                    })
                });
                else if (t.hasClass("banner__slider")) {
                    var l = 2 * Math.PI * 9,
                        c = 2 * Math.PI * 10.5;
                    window.innerWidth < breakpoint.tbx && (p = 1500);
                    var d = {
                        time: 0,
                        paused: !1,
                        hover: !1,
                        init: function(a) {
                            var i = this,
                                o = a.params.autoplay.delay,
                                s = 0;
                            ! function n() {
                                setTimeout(function() {
                                    var e = Date.now();
                                    if (!i.paused && !i.hover) {
                                        i.time += 0 === s ? 0 : e - s;
                                        var t = i.time >= o ? 1 : i.time / o;
                                        i.onTime(a, t), i.time >= o && i.onNext(a)
                                    }
                                    s = e, n()
                                }, 1e3 / 60)
                            }(), this.stop(a), this.start(a)
                        },
                        start: function(e) {
                            this.paused = !1
                        },
                        stop: function(e) {
                            this.time = 0, this.paused = !0, setTimeout(function() {
                                e.autoplay.stop()
                            }, 0)
                        },
                        pause: function(e) {
                            this.paused = !0
                        },
                        getPaginationElement: function(e) {
                            if (e.pagination.bullets)
                                for (var t = 0; t < e.pagination.bullets.length; t++) {
                                    var n = $(e.pagination.bullets[t]);
                                    if (n.hasClass("banner-pagination-bullet-active")) return {
                                        el: n,
                                        circleDesktop: n.find(".banner-pagination-bullet-desktop circle.banner-pagination-bullet-progress"),
                                        circleMobile: n.find(".banner-pagination-bullet-mobile circle.banner-pagination-bullet-progress")
                                    }
                                }
                            return !1
                        },
                        resetSvg: function() {
                            $("circle.banner-pagination-bullet-progress").attr("stroke-dashoffset", 0)
                        },
                        onNext: function(e) {
                            this.stop(e), e.slideNext()
                        },
                        onTime: function(e, t) {
                            var n = this.getPaginationElement(e);
                            n && (n.circleDesktop.attr("stroke-dashoffset", -t * l), n.circleMobile.attr("stroke-dashoffset", -t * c), 1 <= t && $("circle.banner-pagination-bullet-progress").attr("stroke-dashoffset", 0))
                        }
                    };
                    a = {
                        loop: !0,
                        parallax: !0,
                        threshold: 50,
                        speed: 1e3,
                        loopAdditionalSlides: 0,
                        allowTouchMove: !1,
                        watchSlidesProgress: !0,
                        autoplay: {
                            delay: 5e3,
                            waitForTransition: !0
                        },
                        pagination: {
                            el: $(".banner-pagination"),
                            type: "bullets",
                            clickable: !0,
                            bulletClass: "banner-pagination-bullet",
                            bulletActiveClass: "banner-pagination-bullet-active",
                            renderBullet: function(e, t) {
                                return '\n\n                <div class="'.concat(t, '">\n                  <svg width="20" height="20" class="banner-pagination-bullet-desktop">\n                    <circle \n                      r="9" \n                      cx="10"\n                      cy="10"\n                      class="banner-pagination-bullet-normal" />\n                    <circle \n                      r="9"\n                      cx="10"\n                      cy="10"\n                      stroke-dasharray="').concat(l, '" \n                      class="banner-pagination-bullet-progress" \n                    />\n                  </svg>\n                  <svg width="24" height="24" class="banner-pagination-bullet-mobile">\n                    <circle \n                      r="10.5"\n                      cx="12"\n                      cy="12"\n                      class="banner-pagination-bullet-normal" />\n                    <circle \n                      r="10.5"\n                      cx="12"\n                      cy="12"\n                      stroke-dasharray="').concat(c, '" \n                      class="banner-pagination-bullet-progress" />\n                  </svg>\n                </div>\n              ')
                            }
                        },
                        on: {
                            init: function() {
                                var e = this;
                                d.init(e), $(e.$el).on("mouseenter.swiperAutoplay", function() {
                                    d.hover = !0, d.pause(e)
                                }).on("mouseleave.swiperAutoplay", function() {
                                    d.hover = !1, d.start(e)
                                })
                            },
                            slideChangeTransitionStart: function() {
                                var e = this;
                                d.stop(this), d.resetSvg(this);
                                var t = this.activeIndex,
                                    n = this.previousIndex,
                                    a = (this.realIndex, this.slides),
                                    i = $(a[n]);
                                $(a[t]);
                                setTimeout(function() {
                                    e.animating && (e.allowSlideNext = !1, e.allowSlidePrev = !1)
                                }, 0), $(this.$el).find(".slide-enter-animate").removeClass("slide-enter-animate"), i.addClass("slide-leave-animate")
                            },
                            slideChangeTransitionEnd: function() {
                                var e = this;
                                d.start(this);
                                var t = this.activeIndex,
                                    n = this.previousIndex,
                                    a = this.slides,
                                    i = ($(a[n]), $(a[t]));
                                setTimeout(function() {
                                    e.animating || (e.allowSlideNext = !0, e.allowSlidePrev = !0)
                                }, 0), $(this.$el).find(".slide-leave-animate").removeClass("slide-leave-animate"), i.addClass("slide-enter-animate")
                            },
                            progress: function() {},
                            setTransition: function(e) {}
                        }
                    }, t.data("autoplayBanner", d)
                } else t.hasClass("banner-products-swiper") && (a = $.extend(a, {
                    loop: !0,
                    allowTouchMove: !1
                }));
                0 < p ? setTimeout(function() {
                    n = new Swiper(t, a), t.data("swiper", n), h.swipers.push(n), t.addClass("slider_init");
                    var e = t.find(".banner-pagination");
                    e.length && setTimeout(function() {
                        e.addClass("banner-pagination_init")
                    }, 1e3)
                }, p) : (n = new Swiper(t, a), t.data("swiper", n), h.swipers.push(n), t.addClass("slider_init"))
            })
        },
        swiperTriggersScroll: function() {
            var e = $(".detail-triggers_scroll");
            if (e.length) {
                var o = "detail-triggers_v",
                    s = "detail-triggers_h";
                e.each(function() {
                    var e, t = $(this),
                        n = 5;
                    t.hasClass("detail-triggers_scroll_05") ? n = 5 : t.hasClass("detail-triggers_scroll_06") ? n = 6 : t.hasClass("detail-triggers_scroll_07") && (n = 7);
                    var a = {
                            init: !1,
                            direction: "vertical",
                            slidesPerView: n,
                            loop: !1,
                            autoHeight: !0,
                            autoplay: {
                                delay: 3e3,
                                disableOnInteraction: !1
                            },
                            scrollbar: {
                                el: t.find(".swiper-scrollbar"),
                                draggable: !0
                            },
                            on: {
                                init: function() {
                                    var e = this;
                                    e.$el.on("mouseenter.swiperAutoplay", function() {
                                        e.autoplay.stop()
                                    }).on("mouseleave.swiperAutoplay", function() {
                                        e.autoplay.start()
                                    })
                                }
                            }
                        },
                        i = {
                            init: !1,
                            slidesPerView: "auto",
                            loop: !1,
                            autoplay: {
                                delay: 3e3,
                                disableOnInteraction: !1
                            },
                            scrollbar: {}
                        };
                    window.innerWidth < breakpoint.tbx && !t.hasClass(s) ? (t.addClass(s), e = new Swiper(t, i)) : window.innerWidth > breakpoint.tbx - 1 && !t.hasClass(o) && (t.addClass(o), e = new Swiper(t, a)), e.init(), $(window).on("resize", function() {
                        window.innerWidth < breakpoint.tbx && !t.hasClass(s) ? (e.destroy(!1, !0), t.addClass(s), t.removeClass(o), (e = new Swiper(t, i)).init()) : window.innerWidth > breakpoint.tbx - 1 && !t.hasClass(o) && (e.destroy(!1, !0), t.addClass(o), t.removeClass(s), (e = new Swiper(t, a)).init())
                    })
                })
            }
        },
        swiperSyncAutoplay: function() {
            this.swipers.forEach(function(e) {
                var t = $(e.$el),
                    n = t.attr("data-sync");
                if (n) {
                    var a = $(n);
                    if (a.length) {
                        var i = a.data("swiper");
                        if (!i) return;
                        var o = i.params.speed;
                        if (t.off(".swiperAutoplay"), e.autoplay.stop(), e.params.speed = o, i.on("slideNextTransitionStart", function() {
                                e.slideNext()
                            }), i.on("slidePrevTransitionStart", function() {
                                e.slidePrev()
                            }), a.is("#banner-slider")) {
                            var s = a.data("autoplayBanner");
                            s ? t.is(".triggers") || t.is(".banner-products-swiper") ? t.on("trigger-open banner-open", function() {
                                s.hover = !0, s.pause(e)
                            }).on("trigger-hide banner-hide", function() {
                                s.hover = !1, s.start(e)
                            }) : t.on("mouseenter.swiperAutoplaySync", function() {
                                s.hover = !0, s.pause(e)
                            }).on("mouseleave.swiperAutoplaySync", function() {
                                s.hover = !1, s.start(e)
                            }) : t.on("mouseenter.swiperAutoplaySync", function() {
                                i.autoplay.stop()
                            }).on("mouseleave.swiperAutoplaySync", function() {
                                i.autoplay.start()
                            })
                        } else t.on("mouseenter.swiperAutoplaySync", function() {
                            i.autoplay.stop()
                        }).on("mouseleave.swiperAutoplaySync", function() {
                            i.autoplay.start()
                        })
                    }
                }
            })
        },
        swiperVideoGallery: function() {
            var c = this,
                e = $(".js-swiper-video");
            if (e.length) {
                var d = "js-swiper-video_tablet",
                    p = "js-swiper-video_mobile";
                e.each(function() {
                    var e, t = $(this),
                        n = t.find(".swiper-pagination"),
                        a = t.find(".swiper-button-next-kronos"),
                        i = t.find(".swiper-button-prev-kronos"),
                        o = 2;
                    t.hasClass("video-gallery_wide") && (o = 4);
                    var s = {
                            loop: !0,
                            init: !1,
                            slidesPerView: o,
                            navigation: {
                                nextEl: a,
                                prevEl: i
                            }
                        },
                        r = {
                            init: !1,
                            slidesPerView: 1,
                            slidesPerColumn: 2,
                            navigation: {
                                nextEl: a,
                                prevEl: i
                            }
                        },
                        l = {
                            init: !1,
                            slidesPerView: 1,
                            navigation: {
                                nextEl: a,
                                prevEl: i
                            },
                            pagination: {
                                el: n,
                                type: "fraction",
                                renderFraction: function(e, t) {
                                    return 'Видео <span class="' + e + '"></span> из <span class="' + t + '"></span>'
                                }
                            }
                        };
                    t.hasClass("video-gallery_mobile") ? window.innerWidth < 768 && !t.hasClass(p) && (t.addClass(p), (e = new Swiper(t, l)).init()) : ((e = window.innerWidth < 768 && !t.hasClass(p) ? (t.addClass(p), new Swiper(t, l)) : window.innerWidth < 1261 && !t.hasClass(d) ? (t.addClass(d), new Swiper(t, r)) : new Swiper(t, s)).init(), t.data("swiper", e), c.swipers.push(e)), $(window).on("resize", function() {
                        t.hasClass("video-gallery_mobile") ? window.innerWidth < 768 && !t.hasClass(p) ? (t.addClass(p), (e = new Swiper(t, l)).init()) : 767 < window.innerWidth && t.hasClass(p) && (t.removeClass(p), e.destroy(!1, !0)) : (window.innerWidth < 768 && !t.hasClass(p) && (t.removeClass(d).addClass(p), e.destroy(!1, !0), (e = new Swiper(t, l)).init()), window.innerWidth < 1261 && 767 < window.innerWidth && !t.hasClass(d) ? (t.removeClass(p).addClass(d), e.destroy(!1, !0), (e = new Swiper(t, r)).init()) : 1260 < window.innerWidth && (t.hasClass(d) || t.hasClass(p)) && (t.removeClass(d).removeClass(p), e.destroy(!1, !0), (e = new Swiper(t, s)).init()))
                    })
                })
            }
        },
        swiperDocGallery: function() {
            var e = $(".js-swiper-docs");
            if (e.length) new Swiper(e, {
                autoplay: {
                    delay: 3e3
                },
                loop: !0,
                slidesPerView: "auto",
                disableOnInteraction: !1,
                slideToClickedSlide: !0
            })
        },
        lang: function() {
            $(document).on("click", ".lang", function(e) {
                e.preventDefault(), $(this).removeClass("lang_hide")
            }).on("click", ".lang a[data-lang]", function(e) {
                e.preventDefault(), e.stopPropagation();
                var t = $(this),
                    n = t.siblings(),
                    a = t.parent(),
                    i = t.closest(".lang"),
                    o = i.attr("data-lang"),
                    s = t.attr("data-lang");
                if (o !== s) {
                    var r = $(".lang__current", i),
                        l = $(".lang__flag", t);
                    r.html(l.html()), i.attr("data-lang", s), n.removeClass("active"), t.addClass("active"), a.prepend(t), i.trigger("changeLang", {
                        lang: s
                    })
                } else i.addClass("lang_hide")
            })
        },
        menu: function() {
            $(document).on("mouseenter", ".menu__drop a", function() {
                var e = $(this),
                    t = e.closest(".menu__drop"),
                    n = $(".menu__drop-bg", t),
                    a = e.attr("data-image");
                n.css({
                    backgroundImage: "url(" + a + ")"
                })
            }), $(document).on("mouseenter", ".menu-drop-item", function() {
                $("img[data-src]", this).each(function() {
                    $(this).attr("src", $(this).attr("data-src"))
                })
            })
        },
        tabs: function() {
            var o = $("body");
            $(document).on("click", ".js-close-tab", function(e) {
                e.preventDefault();
                var t = $(this).closest(".tabs-container");
                $(".js-tab").removeClass("open"), t.removeClass("tabs-container_open"), o.removeClass("tabs-container-open")
            }), $(document).on("click", ".js-tab", function(e) {
                e.preventDefault();
                var t = $(this),
                    n = t.attr("href"),
                    a = $(n),
                    i = a.closest(".tabs-container");
                $(".js-tab", t.closest(".tabs")).removeClass("active").removeClass("open"), t.addClass("active").addClass("open"), $(".js-tab-container", i).removeClass("active"), a.addClass("active"), i.addClass("tabs-container_open"), o.addClass("tabs-container-open")
            })
        },
        customScroll: function() {
            $(".js-custom-scroll-y").each(function() {
                var e = $(this);
                e.hasClass("faq") && window.innerWidth < 767 || e.mCustomScrollbar({
                    theme: "kronos",
                    scrollInertia: 0,
                    axis: "y"
                })
            })
        },
        detailGallery: function() {
            var a = this,
                t = $(".detail-gallery-pagination__active"),
                n = $(".detail-gallery-pagination__count"),
                e = $(".detail-gallery-thumbs"),
                i = $(".detail-gallery"),
                o = $(window);
            if (e.length && i.length) {
                var s = new Swiper(e, {
                        slidesPerView: 5,
                        preloadImages: !1,
                        lazy: !0,
                        centeredSlides: !0,
                        slideToClickedSlide: !0
                    }),
                    r = new Swiper(".detail-gallery", {
                        preloadImages: !1,
                        lazy: !0,
                        navigation: {
                            nextEl: ".detail-gallery .swiper-button-next-kronos",
                            prevEl: ".detail-gallery .swiper-button-prev-kronos"
                        },
                        on: {
                            init: function() {
                                d(this)
                            },
                            slideChange: function() {
                                d(this)
                            },
                            lazyImageReady: function(e, t) {
                                if (!(o.width() <= 767)) {
                                    var n = $(t);
                                    n.hasClass("cloudzoom-image") && a.cloudZoom(n, {
                                        zoomPosition: "inside",
                                        autoInside: !0
                                    })
                                }
                            }
                        }
                    });
                (r.controller.control = s).controller.control = r;
                var l = new Swiper(".detail-banner", {
                        preloadImages: !1,
                        lazy: !0,
                        navigation: {
                            nextEl: ".detail-banner .swiper-button-next-kronos",
                            prevEl: ".detail-banner .swiper-button-prev-kronos"
                        }
                    }),
                    c = new Swiper(".detail-sert", {
                        preloadImages: !1,
                        lazy: !0,
                        direction: "vertical",
                        slidesPerView: 3,
                        spaceBetween: 11,
                        navigation: {
                            nextEl: ".detail-sert .swiper-button-next-kronos",
                            prevEl: ".detail-sert .swiper-button-prev-kronos"
                        }
                    });
                this.swipers.push(r, s, l, c)
            }

            function d(e) {
                t.text(e.activeIndex + 1), n.text(e.slides.length)
            }
        },
        fileInput: function() {
            var e = 0 < arguments.length && void 0 !== arguments[0] ? arguments[0] : "body",
                t = $(".input-file__input", e);
            t.length && t.each(function() {
                var e = $(this),
                    a = e.next("label"),
                    i = a.html();
                e.on("change", function(e) {
                    var t = "",
                        n = $(this);
                    n.files && 1 < n.files.length ? t = (n.getAttribute("data-multiple-caption") || "").replace("{count}", n.files.length) : e.target.value && (t = e.target.value.split("\\").pop()), t ? a.find("span").html(t) : a.html(i)
                }), e.on("focus", function() {
                    e.addClass("has-focus")
                }).on("blur", function() {
                    e.removeClass("has-focus")
                })
            })
        },
        factsTurn: function() {
            $(document).on("click", ".js-facts-btn, .facts.close .facts-label", function(e) {
                e.preventDefault();
                var t = $(this).parents(".facts"),
                    n = t.find(".facts__list");
                t.hasClass("close") ? n.slideDown({
                    complete: function() {
                        t.removeClass("close")
                    }
                }) : n.slideUp({
                    start: function() {
                        t.addClass("close")
                    }
                })
            })
        },
        bannerDownload: function() {
            var a = $(".js-banner-download");
            if (a.length) {
                $("html, body");
                var i = $("body"),
                    o = $(window);
                o.scroll(function(e) {
                    var t = o.scrollTop(),
                        n = window.innerHeight;
                    document.body.offsetHeight - a.height() <= t + n ? i.addClass("banner-download-active") : i.removeClass("banner-download-active")
                })
            }
        }
    };
window.svg4everybody && svg4everybody(), $(function() {
    App.init(), $(window).on("load.App", function() {
        App.initOnLoad()
    }).on("resize.App", function() {
        App.initOnResize()
    })
});