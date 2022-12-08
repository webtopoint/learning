(function($) {
    $(document).ready(function() {
        $("#cssmenu ul ul:eq(0)").show();
        $('#cssmenu > ul > li > a').click(function() {
            $('#cssmenu li').removeClass('active');
            $(this).closest('li').addClass('active');
            var checkElement = $(this).next();
            if ((checkElement.is('ul')) && (checkElement.is(':visible'))) {
                $(this).closest('li').removeClass('active');
                checkElement.slideUp('normal');
            }
            if ((checkElement.is('ul')) && (!checkElement.is(':visible'))) {
                $('#cssmenu ul ul:visible').slideUp('normal');
                checkElement.slideDown('normal');
            }
            if ($(this).closest('li').find('ul').children().length == 0) {
                return true;
            } else {
                return false;
            }
        });
    });
})(jQuery);;
/*!
 * Bootstrap v3.1.0 (http://getbootstrap.com)
 * Copyright 2011-2014 Twitter, Inc.
 * Licensed under MIT (https://github.com/twbs/bootstrap/blob/master/LICENSE)
 */
if ("undefined" == typeof jQuery) throw new Error("Bootstrap requires jQuery"); + function(a) {
    "use strict";

    function b() {
        var a = document.createElement("bootstrap"),
            b = {
                WebkitTransition: "webkitTransitionEnd",
                MozTransition: "transitionend",
                OTransition: "oTransitionEnd otransitionend",
                transition: "transitionend"
            };
        for (var c in b)
            if (void 0 !== a.style[c]) return {
                end: b[c]
            };
        return !1
    }
    a.fn.emulateTransitionEnd = function(b) {
        var c = !1,
            d = this;
        a(this).one(a.support.transition.end, function() {
            c = !0
        });
        var e = function() {
            c || a(d).trigger(a.support.transition.end)
        };
        return setTimeout(e, b), this
    }, a(function() {
        a.support.transition = b()
    })
}(jQuery), + function(a) {
    "use strict";
    var b = '[data-dismiss="alert"]',
        c = function(c) {
            a(c).on("click", b, this.close)
        };
    c.prototype.close = function(b) {
        function c() {
            f.trigger("closed.bs.alert").remove()
        }
        var d = a(this),
            e = d.attr("data-target");
        e || (e = d.attr("href"), e = e && e.replace(/.*(?=#[^\s]*$)/, ""));
        var f = a(e);
        b && b.preventDefault(), f.length || (f = d.hasClass("alert") ? d : d.parent()), f.trigger(b = a.Event("close.bs.alert")), b.isDefaultPrevented() || (f.removeClass("in"), a.support.transition && f.hasClass("fade") ? f.one(a.support.transition.end, c).emulateTransitionEnd(150) : c())
    };
    var d = a.fn.alert;
    a.fn.alert = function(b) {
        return this.each(function() {
            var d = a(this),
                e = d.data("bs.alert");
            e || d.data("bs.alert", e = new c(this)), "string" == typeof b && e[b].call(d)
        })
    }, a.fn.alert.Constructor = c, a.fn.alert.noConflict = function() {
        return a.fn.alert = d, this
    }, a(document).on("click.bs.alert.data-api", b, c.prototype.close)
}(jQuery), + function(a) {
    "use strict";
    var b = function(c, d) {
        this.$element = a(c), this.options = a.extend({}, b.DEFAULTS, d), this.isLoading = !1
    };
    b.DEFAULTS = {
        loadingText: "loading..."
    }, b.prototype.setState = function(b) {
        var c = "disabled",
            d = this.$element,
            e = d.is("input") ? "val" : "html",
            f = d.data();
        b += "Text", f.resetText || d.data("resetText", d[e]()), d[e](f[b] || this.options[b]), setTimeout(a.proxy(function() {
            "loadingText" == b ? (this.isLoading = !0, d.addClass(c).attr(c, c)) : this.isLoading && (this.isLoading = !1, d.removeClass(c).removeAttr(c))
        }, this), 0)
    }, b.prototype.toggle = function() {
        var a = !0,
            b = this.$element.closest('[data-toggle="buttons"]');
        if (b.length) {
            var c = this.$element.find("input");
            "radio" == c.prop("type") && (c.prop("checked") && this.$element.hasClass("active") ? a = !1 : b.find(".active").removeClass("active")), a && c.prop("checked", !this.$element.hasClass("active")).trigger("change")
        }
        a && this.$element.toggleClass("active")
    };
    var c = a.fn.button;
    a.fn.button = function(c) {
        return this.each(function() {
            var d = a(this),
                e = d.data("bs.button"),
                f = "object" == typeof c && c;
            e || d.data("bs.button", e = new b(this, f)), "toggle" == c ? e.toggle() : c && e.setState(c)
        })
    }, a.fn.button.Constructor = b, a.fn.button.noConflict = function() {
        return a.fn.button = c, this
    }, a(document).on("click.bs.button.data-api", "[data-toggle^=button]", function(b) {
        var c = a(b.target);
        c.hasClass("btn") || (c = c.closest(".btn")), c.button("toggle"), b.preventDefault()
    })
}(jQuery), + function(a) {
    "use strict";
    var b = function(b, c) {
        this.$element = a(b), this.$indicators = this.$element.find(".carousel-indicators"), this.options = c, this.paused = this.sliding = this.interval = this.$active = this.$items = null, "hover" == this.options.pause && this.$element.on("mouseenter", a.proxy(this.pause, this)).on("mouseleave", a.proxy(this.cycle, this))
    };
    b.DEFAULTS = {
        interval: 5e3,
        pause: "hover",
        wrap: !0
    }, b.prototype.cycle = function(b) {
        return b || (this.paused = !1), this.interval && clearInterval(this.interval), this.options.interval && !this.paused && (this.interval = setInterval(a.proxy(this.next, this), this.options.interval)), this
    }, b.prototype.getActiveIndex = function() {
        return this.$active = this.$element.find(".item.active"), this.$items = this.$active.parent().children(), this.$items.index(this.$active)
    }, b.prototype.to = function(b) {
        var c = this,
            d = this.getActiveIndex();
        return b > this.$items.length - 1 || 0 > b ? void 0 : this.sliding ? this.$element.one("slid.bs.carousel", function() {
            c.to(b)
        }) : d == b ? this.pause().cycle() : this.slide(b > d ? "next" : "prev", a(this.$items[b]))
    }, b.prototype.pause = function(b) {
        return b || (this.paused = !0), this.$element.find(".next, .prev").length && a.support.transition && (this.$element.trigger(a.support.transition.end), this.cycle(!0)), this.interval = clearInterval(this.interval), this
    }, b.prototype.next = function() {
        return this.sliding ? void 0 : this.slide("next")
    }, b.prototype.prev = function() {
        return this.sliding ? void 0 : this.slide("prev")
    }, b.prototype.slide = function(b, c) {
        var d = this.$element.find(".item.active"),
            e = c || d[b](),
            f = this.interval,
            g = "next" == b ? "left" : "right",
            h = "next" == b ? "first" : "last",
            i = this;
        if (!e.length) {
            if (!this.options.wrap) return;
            e = this.$element.find(".item")[h]()
        }
        if (e.hasClass("active")) return this.sliding = !1;
        var j = a.Event("slide.bs.carousel", {
            relatedTarget: e[0],
            direction: g
        });
        return this.$element.trigger(j), j.isDefaultPrevented() ? void 0 : (this.sliding = !0, f && this.pause(), this.$indicators.length && (this.$indicators.find(".active").removeClass("active"), this.$element.one("slid.bs.carousel", function() {
            var b = a(i.$indicators.children()[i.getActiveIndex()]);
            b && b.addClass("active")
        })), a.support.transition && this.$element.hasClass("slide") ? (e.addClass(b), e[0].offsetWidth, d.addClass(g), e.addClass(g), d.one(a.support.transition.end, function() {
            e.removeClass([b, g].join(" ")).addClass("active"), d.removeClass(["active", g].join(" ")), i.sliding = !1, setTimeout(function() {
                i.$element.trigger("slid.bs.carousel")
            }, 0)
        }).emulateTransitionEnd(1e3 * d.css("transition-duration").slice(0, -1))) : (d.removeClass("active"), e.addClass("active"), this.sliding = !1, this.$element.trigger("slid.bs.carousel")), f && this.cycle(), this)
    };
    var c = a.fn.carousel;
    a.fn.carousel = function(c) {
        return this.each(function() {
            var d = a(this),
                e = d.data("bs.carousel"),
                f = a.extend({}, b.DEFAULTS, d.data(), "object" == typeof c && c),
                g = "string" == typeof c ? c : f.slide;
            e || d.data("bs.carousel", e = new b(this, f)), "number" == typeof c ? e.to(c) : g ? e[g]() : f.interval && e.pause().cycle()
        })
    }, a.fn.carousel.Constructor = b, a.fn.carousel.noConflict = function() {
        return a.fn.carousel = c, this
    }, a(document).on("click.bs.carousel.data-api", "[data-slide], [data-slide-to]", function(b) {
        var c, d = a(this),
            e = a(d.attr("data-target") || (c = d.attr("href")) && c.replace(/.*(?=#[^\s]+$)/, "")),
            f = a.extend({}, e.data(), d.data()),
            g = d.attr("data-slide-to");
        g && (f.interval = !1), e.carousel(f), (g = d.attr("data-slide-to")) && e.data("bs.carousel").to(g), b.preventDefault()
    }), a(window).on("load", function() {
        a('[data-ride="carousel"]').each(function() {
            var b = a(this);
            b.carousel(b.data())
        })
    })
}(jQuery), + function(a) {
    "use strict";
    var b = function(c, d) {
        this.$element = a(c), this.options = a.extend({}, b.DEFAULTS, d), this.transitioning = null, this.options.parent && (this.$parent = a(this.options.parent)), this.options.toggle && this.toggle()
    };
    b.DEFAULTS = {
        toggle: !0
    }, b.prototype.dimension = function() {
        var a = this.$element.hasClass("width");
        return a ? "width" : "height"
    }, b.prototype.show = function() {
        if (!this.transitioning && !this.$element.hasClass("in")) {
            var b = a.Event("show.bs.collapse");
            if (this.$element.trigger(b), !b.isDefaultPrevented()) {
                var c = this.$parent && this.$parent.find("> .panel > .in");
                if (c && c.length) {
                    var d = c.data("bs.collapse");
                    if (d && d.transitioning) return;
                    c.collapse("hide"), d || c.data("bs.collapse", null)
                }
                var e = this.dimension();
                this.$element.removeClass("collapse").addClass("collapsing")[e](0), this.transitioning = 1;
                var f = function() {
                    this.$element.removeClass("collapsing").addClass("collapse in")[e]("auto"), this.transitioning = 0, this.$element.trigger("shown.bs.collapse")
                };
                if (!a.support.transition) return f.call(this);
                var g = a.camelCase(["scroll", e].join("-"));
                this.$element.one(a.support.transition.end, a.proxy(f, this)).emulateTransitionEnd(350)[e](this.$element[0][g])
            }
        }
    }, b.prototype.hide = function() {
        if (!this.transitioning && this.$element.hasClass("in")) {
            var b = a.Event("hide.bs.collapse");
            if (this.$element.trigger(b), !b.isDefaultPrevented()) {
                var c = this.dimension();
                this.$element[c](this.$element[c]())[0].offsetHeight, this.$element.addClass("collapsing").removeClass("collapse").removeClass("in"), this.transitioning = 1;
                var d = function() {
                    this.transitioning = 0, this.$element.trigger("hidden.bs.collapse").removeClass("collapsing").addClass("collapse")
                };
                return a.support.transition ? void this.$element[c](0).one(a.support.transition.end, a.proxy(d, this)).emulateTransitionEnd(350) : d.call(this)
            }
        }
    }, b.prototype.toggle = function() {
        this[this.$element.hasClass("in") ? "hide" : "show"]()
    };
    var c = a.fn.collapse;
    a.fn.collapse = function(c) {
        return this.each(function() {
            var d = a(this),
                e = d.data("bs.collapse"),
                f = a.extend({}, b.DEFAULTS, d.data(), "object" == typeof c && c);
            !e && f.toggle && "show" == c && (c = !c), e || d.data("bs.collapse", e = new b(this, f)), "string" == typeof c && e[c]()
        })
    }, a.fn.collapse.Constructor = b, a.fn.collapse.noConflict = function() {
        return a.fn.collapse = c, this
    }, a(document).on("click.bs.collapse.data-api", "[data-toggle=collapse]", function(b) {
        var c, d = a(this),
            e = d.attr("data-target") || b.preventDefault() || (c = d.attr("href")) && c.replace(/.*(?=#[^\s]+$)/, ""),
            f = a(e),
            g = f.data("bs.collapse"),
            h = g ? "toggle" : d.data(),
            i = d.attr("data-parent"),
            j = i && a(i);
        g && g.transitioning || (j && j.find('[data-toggle=collapse][data-parent="' + i + '"]').not(d).addClass("collapsed"), d[f.hasClass("in") ? "addClass" : "removeClass"]("collapsed")), f.collapse(h)
    })
}(jQuery), + function(a) {
    "use strict";

    var g = a.fn.dropdown;
    a.fn.dropdown = function(b) {
        return this.each(function() {
            var c = a(this),
                d = c.data("bs.dropdown");
            d || c.data("bs.dropdown", d = new f(this)), "string" == typeof b && d[b].call(c)
        })
    }, a.fn.dropdown.Constructor = f, a.fn.dropdown.noConflict = function() {
        return a.fn.dropdown = g, this
    }, a(document).on("click.bs.dropdown.data-api", b).on("click.bs.dropdown.data-api", ".dropdown form", function(a) {
        a.stopPropagation()
    }).on("click.bs.dropdown.data-api", e, f.prototype.toggle).on("keydown.bs.dropdown.data-api", e + ", [role=menu], [role=listbox]", f.prototype.keydown)
}(jQuery), + function(a) {
    "use strict";
    var b = function(b, c) {
        this.options = c, this.$element = a(b), this.$backdrop = this.isShown = null, this.options.remote && this.$element.find(".modal-content").load(this.options.remote, a.proxy(function() {
            this.$element.trigger("loaded.bs.modal")
        }, this))
    };
    b.DEFAULTS = {
        backdrop: !0,
        keyboard: !0,
        show: !0
    }, b.prototype.toggle = function(a) {
        return this[this.isShown ? "hide" : "show"](a)
    }, b.prototype.show = function(b) {
        var c = this,
            d = a.Event("show.bs.modal", {
                relatedTarget: b
            });
        this.$element.trigger(d), this.isShown || d.isDefaultPrevented() || (this.isShown = !0, this.escape(), this.$element.on("click.dismiss.bs.modal", '[data-dismiss="modal"]', a.proxy(this.hide, this)), this.backdrop(function() {
            var d = a.support.transition && c.$element.hasClass("fade");
            c.$element.parent().length || c.$element.appendTo(document.body), c.$element.show().scrollTop(0), d && c.$element[0].offsetWidth, c.$element.addClass("in").attr("aria-hidden", !1), c.enforceFocus();
            var e = a.Event("shown.bs.modal", {
                relatedTarget: b
            });
            d ? c.$element.find(".modal-dialog").one(a.support.transition.end, function() {
                c.$element.focus().trigger(e)
            }).emulateTransitionEnd(300) : c.$element.focus().trigger(e)
        }))
    }, b.prototype.hide = function(b) {
        b && b.preventDefault(), b = a.Event("hide.bs.modal"), this.$element.trigger(b), this.isShown && !b.isDefaultPrevented() && (this.isShown = !1, this.escape(), a(document).off("focusin.bs.modal"), this.$element.removeClass("in").attr("aria-hidden", !0).off("click.dismiss.bs.modal"), a.support.transition && this.$element.hasClass("fade") ? this.$element.one(a.support.transition.end, a.proxy(this.hideModal, this)).emulateTransitionEnd(300) : this.hideModal())
    }, b.prototype.enforceFocus = function() {
        a(document).off("focusin.bs.modal").on("focusin.bs.modal", a.proxy(function(a) {
            this.$element[0] === a.target || this.$element.has(a.target).length || this.$element.focus()
        }, this))
    }, b.prototype.escape = function() {
        this.isShown && this.options.keyboard ? this.$element.on("keyup.dismiss.bs.modal", a.proxy(function(a) {
            27 == a.which && this.hide()
        }, this)) : this.isShown || this.$element.off("keyup.dismiss.bs.modal")
    }, b.prototype.hideModal = function() {
        var a = this;
        this.$element.hide(), this.backdrop(function() {
            a.removeBackdrop(), a.$element.trigger("hidden.bs.modal")
        })
    }, b.prototype.removeBackdrop = function() {
        this.$backdrop && this.$backdrop.remove(), this.$backdrop = null
    }, b.prototype.backdrop = function(b) {
        var c = this.$element.hasClass("fade") ? "fade" : "";
        if (this.isShown && this.options.backdrop) {
            var d = a.support.transition && c;
            if (this.$backdrop = a('<div class="modal-backdrop ' + c + '" />').appendTo(document.body), this.$element.on("click.dismiss.bs.modal", a.proxy(function(a) {
                a.target === a.currentTarget && ("static" == this.options.backdrop ? this.$element[0].focus.call(this.$element[0]) : this.hide.call(this))
            }, this)), d && this.$backdrop[0].offsetWidth, this.$backdrop.addClass("in"), !b) return;
            d ? this.$backdrop.one(a.support.transition.end, b).emulateTransitionEnd(150) : b()
        } else !this.isShown && this.$backdrop ? (this.$backdrop.removeClass("in"), a.support.transition && this.$element.hasClass("fade") ? this.$backdrop.one(a.support.transition.end, b).emulateTransitionEnd(150) : b()) : b && b()
    };
    var c = a.fn.modal;
    a.fn.modal = function(c, d) {
        return this.each(function() {
            var e = a(this),
                f = e.data("bs.modal"),
                g = a.extend({}, b.DEFAULTS, e.data(), "object" == typeof c && c);
            f || e.data("bs.modal", f = new b(this, g)), "string" == typeof c ? f[c](d) : g.show && f.show(d)
        })
    }, a.fn.modal.Constructor = b, a.fn.modal.noConflict = function() {
        return a.fn.modal = c, this
    }, a(document).on("click.bs.modal.data-api", '[data-toggle="modal"]', function(b) {
        var c = a(this),
            d = c.attr("href"),
            e = a(c.attr("data-target") || d && d.replace(/.*(?=#[^\s]+$)/, "")),
            f = e.data("bs.modal") ? "toggle" : a.extend({
                remote: !/#/.test(d) && d
            }, e.data(), c.data());
        c.is("a") && b.preventDefault(), e.modal(f, this).one("hide", function() {
            c.is(":visible") && c.focus()
        })
    }), a(document).on("show.bs.modal", ".modal", function() {
        a(document.body).addClass("modal-open")
    }).on("hidden.bs.modal", ".modal", function() {
        a(document.body).removeClass("modal-open")
    })
}(jQuery), + function(a) {
    "use strict";
    var b = function(a, b) {
        this.type = this.options = this.enabled = this.timeout = this.hoverState = this.$element = null, this.init("tooltip", a, b)
    };
    b.DEFAULTS = {
        animation: !0,
        placement: "top",
        selector: !1,
        template: '<div class="tooltip"><div class="tooltip-arrow"></div><div class="tooltip-inner"></div></div>',
        trigger: "hover focus",
        title: "",
        delay: 0,
        html: !1,
        container: !1
    }, b.prototype.init = function(b, c, d) {
        this.enabled = !0, this.type = b, this.$element = a(c), this.options = this.getOptions(d);
        for (var e = this.options.trigger.split(" "), f = e.length; f--;) {
            var g = e[f];
            if ("click" == g) this.$element.on("click." + this.type, this.options.selector, a.proxy(this.toggle, this));
            else if ("manual" != g) {
                var h = "hover" == g ? "mouseenter" : "focusin",
                    i = "hover" == g ? "mouseleave" : "focusout";
                this.$element.on(h + "." + this.type, this.options.selector, a.proxy(this.enter, this)), this.$element.on(i + "." + this.type, this.options.selector, a.proxy(this.leave, this))
            }
        }
        this.options.selector ? this._options = a.extend({}, this.options, {
            trigger: "manual",
            selector: ""
        }) : this.fixTitle()
    }, b.prototype.getDefaults = function() {
        return b.DEFAULTS
    }, b.prototype.getOptions = function(b) {
        return b = a.extend({}, this.getDefaults(), this.$element.data(), b), b.delay && "number" == typeof b.delay && (b.delay = {
            show: b.delay,
            hide: b.delay
        }), b
    }, b.prototype.getDelegateOptions = function() {
        var b = {}, c = this.getDefaults();
        return this._options && a.each(this._options, function(a, d) {
            c[a] != d && (b[a] = d)
        }), b
    }, b.prototype.enter = function(b) {
        var c = b instanceof this.constructor ? b : a(b.currentTarget)[this.type](this.getDelegateOptions()).data("bs." + this.type);
        return clearTimeout(c.timeout), c.hoverState = "in", c.options.delay && c.options.delay.show ? void(c.timeout = setTimeout(function() {
            "in" == c.hoverState && c.show()
        }, c.options.delay.show)) : c.show()
    }, b.prototype.leave = function(b) {
        var c = b instanceof this.constructor ? b : a(b.currentTarget)[this.type](this.getDelegateOptions()).data("bs." + this.type);
        return clearTimeout(c.timeout), c.hoverState = "out", c.options.delay && c.options.delay.hide ? void(c.timeout = setTimeout(function() {
            "out" == c.hoverState && c.hide()
        }, c.options.delay.hide)) : c.hide()
    }, b.prototype.show = function() {
        var b = a.Event("show.bs." + this.type);
        if (this.hasContent() && this.enabled) {
            if (this.$element.trigger(b), b.isDefaultPrevented()) return;
            var c = this,
                d = this.tip();
            this.setContent(), this.options.animation && d.addClass("fade");
            var e = "function" == typeof this.options.placement ? this.options.placement.call(this, d[0], this.$element[0]) : this.options.placement,
                f = /\s?auto?\s?/i,
                g = f.test(e);
            g && (e = e.replace(f, "") || "top"), d.detach().css({
                top: 0,
                left: 0,
                display: "block"
            }).addClass(e), this.options.container ? d.appendTo(this.options.container) : d.insertAfter(this.$element);
            var h = this.getPosition(),
                i = d[0].offsetWidth,
                j = d[0].offsetHeight;
            if (g) {
                var k = this.$element.parent(),
                    l = e,
                    m = document.documentElement.scrollTop || document.body.scrollTop,
                    n = "body" == this.options.container ? window.innerWidth : k.outerWidth(),
                    o = "body" == this.options.container ? window.innerHeight : k.outerHeight(),
                    p = "body" == this.options.container ? 0 : k.offset().left;
                e = "bottom" == e && h.top + h.height + j - m > o ? "top" : "top" == e && h.top - m - j < 0 ? "bottom" : "right" == e && h.right + i > n ? "left" : "left" == e && h.left - i < p ? "right" : e, d.removeClass(l).addClass(e)
            }
            var q = this.getCalculatedOffset(e, h, i, j);
            this.applyPlacement(q, e), this.hoverState = null;
            var r = function() {
                c.$element.trigger("shown.bs." + c.type)
            };
            a.support.transition && this.$tip.hasClass("fade") ? d.one(a.support.transition.end, r).emulateTransitionEnd(150) : r()
        }
    }, b.prototype.applyPlacement = function(b, c) {
        var d, e = this.tip(),
            f = e[0].offsetWidth,
            g = e[0].offsetHeight,
            h = parseInt(e.css("margin-top"), 10),
            i = parseInt(e.css("margin-left"), 10);
        isNaN(h) && (h = 0), isNaN(i) && (i = 0), b.top = b.top + h, b.left = b.left + i, a.offset.setOffset(e[0], a.extend({
            using: function(a) {
                e.css({
                    top: Math.round(a.top),
                    left: Math.round(a.left)
                })
            }
        }, b), 0), e.addClass("in");
        var j = e[0].offsetWidth,
            k = e[0].offsetHeight;
        if ("top" == c && k != g && (d = !0, b.top = b.top + g - k), /bottom|top/.test(c)) {
            var l = 0;
            b.left < 0 && (l = -2 * b.left, b.left = 0, e.offset(b), j = e[0].offsetWidth, k = e[0].offsetHeight), this.replaceArrow(l - f + j, j, "left")
        } else this.replaceArrow(k - g, k, "top");
        d && e.offset(b)
    }, b.prototype.replaceArrow = function(a, b, c) {
        this.arrow().css(c, a ? 50 * (1 - a / b) + "%" : "")
    }, b.prototype.setContent = function() {
        var a = this.tip(),
            b = this.getTitle();
        a.find(".tooltip-inner")[this.options.html ? "html" : "text"](b), a.removeClass("fade in top bottom left right")
    }, b.prototype.hide = function() {
        function b() {
            "in" != c.hoverState && d.detach(), c.$element.trigger("hidden.bs." + c.type)
        }
        var c = this,
            d = this.tip(),
            e = a.Event("hide.bs." + this.type);
        return this.$element.trigger(e), e.isDefaultPrevented() ? void 0 : (d.removeClass("in"), a.support.transition && this.$tip.hasClass("fade") ? d.one(a.support.transition.end, b).emulateTransitionEnd(150) : b(), this.hoverState = null, this)
    }, b.prototype.fixTitle = function() {
        var a = this.$element;
        (a.attr("title") || "string" != typeof a.attr("data-original-title")) && a.attr("data-original-title", a.attr("title") || "").attr("title", "")
    }, b.prototype.hasContent = function() {
        return this.getTitle()
    }, b.prototype.getPosition = function() {
        var b = this.$element[0];
        return a.extend({}, "function" == typeof b.getBoundingClientRect ? b.getBoundingClientRect() : {
            width: b.offsetWidth,
            height: b.offsetHeight
        }, this.$element.offset())
    }, b.prototype.getCalculatedOffset = function(a, b, c, d) {
        return "bottom" == a ? {
            top: b.top + b.height,
            left: b.left + b.width / 2 - c / 2
        } : "top" == a ? {
            top: b.top - d,
            left: b.left + b.width / 2 - c / 2
        } : "left" == a ? {
            top: b.top + b.height / 2 - d / 2,
            left: b.left - c
        } : {
            top: b.top + b.height / 2 - d / 2,
            left: b.left + b.width
        }
    }, b.prototype.getTitle = function() {
        var a, b = this.$element,
            c = this.options;
        return a = b.attr("data-original-title") || ("function" == typeof c.title ? c.title.call(b[0]) : c.title)
    }, b.prototype.tip = function() {
        return this.$tip = this.$tip || a(this.options.template)
    }, b.prototype.arrow = function() {
        return this.$arrow = this.$arrow || this.tip().find(".tooltip-arrow")
    }, b.prototype.validate = function() {
        this.$element[0].parentNode || (this.hide(), this.$element = null, this.options = null)
    }, b.prototype.enable = function() {
        this.enabled = !0
    }, b.prototype.disable = function() {
        this.enabled = !1
    }, b.prototype.toggleEnabled = function() {
        this.enabled = !this.enabled
    }, b.prototype.toggle = function(b) {
        var c = b ? a(b.currentTarget)[this.type](this.getDelegateOptions()).data("bs." + this.type) : this;
        c.tip().hasClass("in") ? c.leave(c) : c.enter(c)
    }, b.prototype.destroy = function() {
        clearTimeout(this.timeout), this.hide().$element.off("." + this.type).removeData("bs." + this.type)
    };
    var c = a.fn.tooltip;
    a.fn.tooltip = function(c) {
        return this.each(function() {
            var d = a(this),
                e = d.data("bs.tooltip"),
                f = "object" == typeof c && c;
            (e || "destroy" != c) && (e || d.data("bs.tooltip", e = new b(this, f)), "string" == typeof c && e[c]())
        })
    }, a.fn.tooltip.Constructor = b, a.fn.tooltip.noConflict = function() {
        return a.fn.tooltip = c, this
    }
}(jQuery), + function(a) {
    "use strict";
    var b = function(a, b) {
        this.init("popover", a, b)
    };
    if (!a.fn.tooltip) throw new Error("Popover requires tooltip.js");
    b.DEFAULTS = a.extend({}, a.fn.tooltip.Constructor.DEFAULTS, {
        placement: "right",
        trigger: "click",
        content: "",
        template: '<div class="popover"><div class="arrow"></div><h3 class="popover-title"></h3><div class="popover-content"></div></div>'
    }), b.prototype = a.extend({}, a.fn.tooltip.Constructor.prototype), b.prototype.constructor = b, b.prototype.getDefaults = function() {
        return b.DEFAULTS
    }, b.prototype.setContent = function() {
        var a = this.tip(),
            b = this.getTitle(),
            c = this.getContent();
        a.find(".popover-title")[this.options.html ? "html" : "text"](b), a.find(".popover-content")[this.options.html ? "string" == typeof c ? "html" : "append" : "text"](c), a.removeClass("fade top bottom left right in"), a.find(".popover-title").html() || a.find(".popover-title").hide()
    }, b.prototype.hasContent = function() {
        return this.getTitle() || this.getContent()
    }, b.prototype.getContent = function() {
        var a = this.$element,
            b = this.options;
        return a.attr("data-content") || ("function" == typeof b.content ? b.content.call(a[0]) : b.content)
    }, b.prototype.arrow = function() {
        return this.$arrow = this.$arrow || this.tip().find(".arrow")
    }, b.prototype.tip = function() {
        return this.$tip || (this.$tip = a(this.options.template)), this.$tip
    };
    var c = a.fn.popover;
    a.fn.popover = function(c) {
        return this.each(function() {
            var d = a(this),
                e = d.data("bs.popover"),
                f = "object" == typeof c && c;
            (e || "destroy" != c) && (e || d.data("bs.popover", e = new b(this, f)), "string" == typeof c && e[c]())
        })
    }, a.fn.popover.Constructor = b, a.fn.popover.noConflict = function() {
        return a.fn.popover = c, this
    }
}(jQuery), + function(a) {
    "use strict";

    function b(c, d) {
        var e, f = a.proxy(this.process, this);
        this.$element = a(a(c).is("body") ? window : c), this.$body = a("body"), this.$scrollElement = this.$element.on("scroll.bs.scroll-spy.data-api", f), this.options = a.extend({}, b.DEFAULTS, d), this.selector = (this.options.target || (e = a(c).attr("href")) && e.replace(/.*(?=#[^\s]+$)/, "") || "") + " .nav li > a", this.offsets = a([]), this.targets = a([]), this.activeTarget = null, this.refresh(), this.process()
    }
    b.DEFAULTS = {
        offset: 10
    }, b.prototype.refresh = function() {
        var b = this.$element[0] == window ? "offset" : "position";
        this.offsets = a([]), this.targets = a([]); {
            var c = this;
            this.$body.find(this.selector).map(function() {
                var d = a(this),
                    e = d.data("target") || d.attr("href"),
                    f = /^#./.test(e) && a(e);
                return f && f.length && f.is(":visible") && [
                    [f[b]().top + (!a.isWindow(c.$scrollElement.get(0)) && c.$scrollElement.scrollTop()), e]
                ] || null
            }).sort(function(a, b) {
                return a[0] - b[0]
            }).each(function() {
                c.offsets.push(this[0]), c.targets.push(this[1])
            })
        }
    }, b.prototype.process = function() {
        var a, b = this.$scrollElement.scrollTop() + this.options.offset,
            c = this.$scrollElement[0].scrollHeight || this.$body[0].scrollHeight,
            d = c - this.$scrollElement.height(),
            e = this.offsets,
            f = this.targets,
            g = this.activeTarget;
        if (b >= d) return g != (a = f.last()[0]) && this.activate(a);
        if (g && b <= e[0]) return g != (a = f[0]) && this.activate(a);
        for (a = e.length; a--;) g != f[a] && b >= e[a] && (!e[a + 1] || b <= e[a + 1]) && this.activate(f[a])
    }, b.prototype.activate = function(b) {
        this.activeTarget = b, a(this.selector).parentsUntil(this.options.target, ".active").removeClass("active");
        var c = this.selector + '[data-target="' + b + '"],' + this.selector + '[href="' + b + '"]',
            d = a(c).parents("li").addClass("active");
        d.parent(".dropdown-menu").length && (d = d.closest("li.dropdown").addClass("active")), d.trigger("activate.bs.scrollspy")
    };
    var c = a.fn.scrollspy;
    a.fn.scrollspy = function(c) {
        return this.each(function() {
            var d = a(this),
                e = d.data("bs.scrollspy"),
                f = "object" == typeof c && c;
            e || d.data("bs.scrollspy", e = new b(this, f)), "string" == typeof c && e[c]()
        })
    }, a.fn.scrollspy.Constructor = b, a.fn.scrollspy.noConflict = function() {
        return a.fn.scrollspy = c, this
    }, a(window).on("load", function() {
        a('[data-spy="scroll"]').each(function() {
            var b = a(this);
            b.scrollspy(b.data())
        })
    })
}(jQuery), + function(a) {
    "use strict";
    var b = function(b) {
        this.element = a(b)
    };
    b.prototype.show = function() {
        var b = this.element,
            c = b.closest("ul:not(.dropdown-menu)"),
            d = b.data("target");
        if (d || (d = b.attr("href"), d = d && d.replace(/.*(?=#[^\s]*$)/, "")), !b.parent("li").hasClass("active")) {
            var e = c.find(".active:last a")[0],
                f = a.Event("show.bs.tab", {
                    relatedTarget: e
                });
            if (b.trigger(f), !f.isDefaultPrevented()) {
                var g = a(d);
                this.activate(b.parent("li"), c), this.activate(g, g.parent(), function() {
                    b.trigger({
                        type: "shown.bs.tab",
                        relatedTarget: e
                    })
                })
            }
        }
    }, b.prototype.activate = function(b, c, d) {
        function e() {
            f.removeClass("active").find("> .dropdown-menu > .active").removeClass("active"), b.addClass("active"), g ? (b[0].offsetWidth, b.addClass("in")) : b.removeClass("fade"), b.parent(".dropdown-menu") && b.closest("li.dropdown").addClass("active"), d && d()
        }
        var f = c.find("> .active"),
            g = d && a.support.transition && f.hasClass("fade");
        g ? f.one(a.support.transition.end, e).emulateTransitionEnd(150) : e(), f.removeClass("in")
    };
    var c = a.fn.tab;
    a.fn.tab = function(c) {
        return this.each(function() {
            var d = a(this),
                e = d.data("bs.tab");
            e || d.data("bs.tab", e = new b(this)), "string" == typeof c && e[c]()
        })
    }, a.fn.tab.Constructor = b, a.fn.tab.noConflict = function() {
        return a.fn.tab = c, this
    }, a(document).on("click.bs.tab.data-api", '[data-toggle="tab"], [data-toggle="pill"]', function(b) {
        b.preventDefault(), a(this).tab("show")
    })
}(jQuery), + function(a) {
    "use strict";
    var b = function(c, d) {
        this.options = a.extend({}, b.DEFAULTS, d), this.$window = a(window).on("scroll.bs.affix.data-api", a.proxy(this.checkPosition, this)).on("click.bs.affix.data-api", a.proxy(this.checkPositionWithEventLoop, this)), this.$element = a(c), this.affixed = this.unpin = this.pinnedOffset = null, this.checkPosition()
    };
    b.RESET = "affix affix-top affix-bottom", b.DEFAULTS = {
        offset: 0
    }, b.prototype.getPinnedOffset = function() {
        if (this.pinnedOffset) return this.pinnedOffset;
        this.$element.removeClass(b.RESET).addClass("affix");
        var a = this.$window.scrollTop(),
            c = this.$element.offset();
        return this.pinnedOffset = c.top - a
    }, b.prototype.checkPositionWithEventLoop = function() {
        setTimeout(a.proxy(this.checkPosition, this), 1)
    }, b.prototype.checkPosition = function() {
        if (this.$element.is(":visible")) {
            var c = a(document).height(),
                d = this.$window.scrollTop(),
                e = this.$element.offset(),
                f = this.options.offset,
                g = f.top,
                h = f.bottom;
            "top" == this.affixed && (e.top += d), "object" != typeof f && (h = g = f), "function" == typeof g && (g = f.top(this.$element)), "function" == typeof h && (h = f.bottom(this.$element));
            var i = null != this.unpin && d + this.unpin <= e.top ? !1 : null != h && e.top + this.$element.height() >= c - h ? "bottom" : null != g && g >= d ? "top" : !1;
            if (this.affixed !== i) {
                this.unpin && this.$element.css("top", "");
                var j = "affix" + (i ? "-" + i : ""),
                    k = a.Event(j + ".bs.affix");
                this.$element.trigger(k), k.isDefaultPrevented() || (this.affixed = i, this.unpin = "bottom" == i ? this.getPinnedOffset() : null, this.$element.removeClass(b.RESET).addClass(j).trigger(a.Event(j.replace("affix", "affixed"))), "bottom" == i && this.$element.offset({
                    top: c - h - this.$element.height()
                }))
            }
        }
    };
    var c = a.fn.affix;
    a.fn.affix = function(c) {
        return this.each(function() {
            var d = a(this),
                e = d.data("bs.affix"),
                f = "object" == typeof c && c;
            e || d.data("bs.affix", e = new b(this, f)), "string" == typeof c && e[c]()
        })
    }, a.fn.affix.Constructor = b, a.fn.affix.noConflict = function() {
        return a.fn.affix = c, this
    }, a(window).on("load", function() {
        a('[data-spy="affix"]').each(function() {
            var b = a(this),
                c = b.data();
            c.offset = c.offset || {}, c.offsetBottom && (c.offset.bottom = c.offsetBottom), c.offsetTop && (c.offset.top = c.offsetTop), b.affix(c)
        })
    })
}(jQuery);;
/*! SWFObject v2.0 <http://code.google.com/p/swfobject/>
 Copyright (c) 2007 Geoff Stearns, Michael Williams, and Bobby van der Sluis
 This software is released under the MIT License <http://www.opensource.org/licenses/mit-license.php>
*/
var swfobject = function() {
    var UNDEF = "undefined",
        OBJECT = "object",
        SHOCKWAVE_FLASH = "Shockwave Flash",
        SHOCKWAVE_FLASH_AX = "ShockwaveFlash.ShockwaveFlash",
        FLASH_MIME_TYPE = "application/x-shockwave-flash",
        EXPRESS_INSTALL_ID = "SWFObjectExprInst",
        win = window,
        doc = document,
        nav = navigator,
        domLoadFnArr = [],
        regObjArr = [],
        timer = null,
        storedAltContent = null,
        storedAltContentId = null,
        isDomLoaded = false,
        isExpressInstallActive = false;
    var ua = function() {
        var w3cdom = typeof doc.getElementById != UNDEF && typeof doc.getElementsByTagName != UNDEF && typeof doc.createElement != UNDEF && typeof doc.appendChild != UNDEF && typeof doc.replaceChild != UNDEF && typeof doc.removeChild != UNDEF && typeof doc.cloneNode != UNDEF,
            playerVersion = [0, 0, 0],
            d = null;
        if (typeof nav.plugins != UNDEF && typeof nav.plugins[SHOCKWAVE_FLASH] == OBJECT) {
            d = nav.plugins[SHOCKWAVE_FLASH].description;
            if (d) {
                d = d.replace(/^.*\s+(\S+\s+\S+$)/, "$1");
                playerVersion[0] = parseInt(d.replace(/^(.*)\..*$/, "$1"), 10);
                playerVersion[1] = parseInt(d.replace(/^.*\.(.*)\s.*$/, "$1"), 10);
                playerVersion[2] = /r/.test(d) ? parseInt(d.replace(/^.*r(.*)$/, "$1"), 10) : 0;
            }
        } else if (typeof win.ActiveXObject != UNDEF) {
            var a = null,
                fp6Crash = false;
            try {
                a = new ActiveXObject(SHOCKWAVE_FLASH_AX + ".7");
            } catch (e) {
                try {
                    a = new ActiveXObject(SHOCKWAVE_FLASH_AX + ".6");
                    playerVersion = [6, 0, 21];
                    a.AllowScriptAccess = "always";
                } catch (e) {
                    if (playerVersion[0] == 6) {
                        fp6Crash = true;
                    }
                }
                if (!fp6Crash) {
                    try {
                        a = new ActiveXObject(SHOCKWAVE_FLASH_AX);
                    } catch (e) {}
                }
            }
            if (!fp6Crash && a) {
                try {
                    d = a.GetVariable("$version");
                    if (d) {
                        d = d.split(" ")[1].split(",");
                        playerVersion = [parseInt(d[0], 10), parseInt(d[1], 10), parseInt(d[2], 10)];
                    }
                } catch (e) {}
            }
        }
        var u = nav.userAgent.toLowerCase(),
            p = nav.platform.toLowerCase(),
            webkit = /webkit/.test(u) ? parseFloat(u.replace(/^.*webkit\/(\d+(\.\d+)?).*$/, "$1")) : false,
            ie = false,
            windows = p ? /win/.test(p) : /win/.test(u),
            mac = p ? /mac/.test(p) : /mac/.test(u);
        /*@cc_on
   ie = true;
   @if (@_win32)
    windows = true;
   @elif (@_mac)
    mac = true;
   @end
  @*/
        return {
            w3cdom: w3cdom,
            pv: playerVersion,
            webkit: webkit,
            ie: ie,
            win: windows,
            mac: mac
        };
    }();
    var onDomLoad = function() {
        if (!ua.w3cdom) {
            return;
        }
        addDomLoadEvent(main);
        if (ua.ie && ua.win) {
            try {
                doc.write("<scr" + "ipt id=__ie_ondomload defer=true src=//:></scr" + "ipt>");
                var s = getElementById("__ie_ondomload");
                if (s) {
                    s.onreadystatechange = function() {
                        if (this.readyState == "complete") {
                            this.parentNode.removeChild(this);
                            callDomLoadFunctions();
                        }
                    };
                }
            } catch (e) {}
        }
        if (ua.webkit && typeof doc.readyState != UNDEF) {
            timer = setInterval(function() {
                if (/loaded|complete/.test(doc.readyState)) {
                    callDomLoadFunctions();
                }
            }, 10);
        }
        if (typeof doc.addEventListener != UNDEF) {
            doc.addEventListener("DOMContentLoaded", callDomLoadFunctions, null);
        }
        addLoadEvent(callDomLoadFunctions);
    }();

    function callDomLoadFunctions() {
        if (isDomLoaded) {
            return;
        }
        if (ua.ie && ua.win) {
            var s = createElement("span");
            try {
                var t = doc.getElementsByTagName("body")[0].appendChild(s);
                t.parentNode.removeChild(t);
            } catch (e) {
                return;
            }
        }
        isDomLoaded = true;
        if (timer) {
            clearInterval(timer);
            timer = null;
        }
        var dl = domLoadFnArr.length;
        for (var i = 0; i < dl; i++) {
            domLoadFnArr[i]();
        }
    }

    function addDomLoadEvent(fn) {
        if (isDomLoaded) {
            fn();
        } else {
            domLoadFnArr[domLoadFnArr.length] = fn;
        }
    }

    function addLoadEvent(fn) {
        if (typeof win.addEventListener != UNDEF) {
            win.addEventListener("load", fn, false);
        } else if (typeof doc.addEventListener != UNDEF) {
            doc.addEventListener("load", fn, false);
        } else if (typeof win.attachEvent != UNDEF) {
            win.attachEvent("onload", fn);
        } else if (typeof win.onload == "function") {
            var fnOld = win.onload;
            win.onload = function() {
                fnOld();
                fn();
            };
        } else {
            win.onload = fn;
        }
    }

    function main() {
        var rl = regObjArr.length;
        for (var i = 0; i < rl; i++) {
            var id = regObjArr[i].id;
            if (ua.pv[0] > 0) {
                var obj = getElementById(id);
                if (obj) {
                    regObjArr[i].width = obj.getAttribute("width") ? obj.getAttribute("width") : "0";
                    regObjArr[i].height = obj.getAttribute("height") ? obj.getAttribute("height") : "0";
                    if (hasPlayerVersion(regObjArr[i].swfVersion)) {
                        if (ua.webkit && ua.webkit < 312) {
                            fixParams(obj);
                        }
                        setVisibility(id, true);
                    } else if (regObjArr[i].expressInstall && !isExpressInstallActive && hasPlayerVersion("6.0.65") && (ua.win || ua.mac)) {
                        showExpressInstall(regObjArr[i]);
                    } else {
                        displayAltContent(obj);
                    }
                }
            } else {
                setVisibility(id, true);
            }
        }
    }

    function fixParams(obj) {
        var nestedObj = obj.getElementsByTagName(OBJECT)[0];
        if (nestedObj) {
            var e = createElement("embed"),
                a = nestedObj.attributes;
            if (a) {
                var al = a.length;
                for (var i = 0; i < al; i++) {
                    if (a[i].nodeName.toLowerCase() == "data") {
                        e.setAttribute("src", a[i].nodeValue);
                    } else {
                        e.setAttribute(a[i].nodeName, a[i].nodeValue);
                    }
                }
            }
            var c = nestedObj.childNodes;
            if (c) {
                var cl = c.length;
                for (var j = 0; j < cl; j++) {
                    if (c[j].nodeType == 1 && c[j].nodeName.toLowerCase() == "param") {
                        e.setAttribute(c[j].getAttribute("name"), c[j].getAttribute("value"));
                    }
                }
            }
            obj.parentNode.replaceChild(e, obj);
        }
    }

    function fixObjectLeaks(id) {
        if (ua.ie && ua.win && hasPlayerVersion("8.0.0")) {
            win.attachEvent("onunload", function() {
                var obj = getElementById(id);
                if (obj) {
                    for (var i in obj) {
                        if (typeof obj[i] == "function") {
                            obj[i] = function() {};
                        }
                    }
                    obj.parentNode.removeChild(obj);
                }
            });
        }
    }

    function showExpressInstall(regObj) {
        isExpressInstallActive = true;
        var obj = getElementById(regObj.id);
        if (obj) {
            if (regObj.altContentId) {
                var ac = getElementById(regObj.altContentId);
                if (ac) {
                    storedAltContent = ac;
                    storedAltContentId = regObj.altContentId;
                }
            } else {
                storedAltContent = abstractAltContent(obj);
            }
            if (!(/%$/.test(regObj.width)) && parseInt(regObj.width, 10) < 310) {
                regObj.width = "310";
            }
            if (!(/%$/.test(regObj.height)) && parseInt(regObj.height, 10) < 137) {
                regObj.height = "137";
            }
            doc.title = doc.title.slice(0, 47) + " - Flash Player Installation";
            var pt = ua.ie && ua.win ? "ActiveX" : "PlugIn",
                dt = doc.title,
                fv = "MMredirectURL=" + win.location + "&MMplayerType=" + pt + "&MMdoctitle=" + dt,
                replaceId = regObj.id;
            if (ua.ie && ua.win && obj.readyState != 4) {
                var newObj = createElement("div");
                replaceId += "SWFObjectNew";
                newObj.setAttribute("id", replaceId);
                obj.parentNode.insertBefore(newObj, obj);
                obj.style.display = "none";
                win.attachEvent("onload", function() {
                    obj.parentNode.removeChild(obj);
                });
            }
            createSWF({
                data: regObj.expressInstall,
                id: EXPRESS_INSTALL_ID,
                width: regObj.width,
                height: regObj.height
            }, {
                flashvars: fv
            }, replaceId);
        }
    }

    function displayAltContent(obj) {
        if (ua.ie && ua.win && obj.readyState != 4) {
            var el = createElement("div");
            obj.parentNode.insertBefore(el, obj);
            el.parentNode.replaceChild(abstractAltContent(obj), el);
            obj.style.display = "none";
            win.attachEvent("onload", function() {
                obj.parentNode.removeChild(obj);
            });
        } else {
            obj.parentNode.replaceChild(abstractAltContent(obj), obj);
        }
    }

    function abstractAltContent(obj) {
        var ac = createElement("div");
        if (ua.win && ua.ie) {
            ac.innerHTML = obj.innerHTML;
        } else {
            var nestedObj = obj.getElementsByTagName(OBJECT)[0];
            if (nestedObj) {
                var c = nestedObj.childNodes;
                if (c) {
                    var cl = c.length;
                    for (var i = 0; i < cl; i++) {
                        if (!(c[i].nodeType == 1 && c[i].nodeName.toLowerCase() == "param") && !(c[i].nodeType == 8)) {
                            ac.appendChild(c[i].cloneNode(true));
                        }
                    }
                }
            }
        }
        return ac;
    }

    function createSWF(attObj, parObj, id) {
        var r, el = getElementById(id);
        if (typeof attObj.id == UNDEF) {
            attObj.id = id;
        }
        if (ua.ie && ua.win) {
            var att = "";
            for (var i in attObj) {
                if (attObj[i] != Object.prototype[i]) {
                    if (i == "data") {
                        parObj.movie = attObj[i];
                    } else if (i.toLowerCase() == "styleclass") {
                        att += ' class="' + attObj[i] + '"';
                    } else if (i != "classid") {
                        att += ' ' + i + '="' + attObj[i] + '"';
                    }
                }
            }
            var par = "";
            for (var j in parObj) {
                if (parObj[j] != Object.prototype[j]) {
                    par += '<param name="' + j + '" value="' + parObj[j] + '" />';
                }
            }
            el.outerHTML = '<object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000"' + att + '>' + par + '</object>';
            fixObjectLeaks(attObj.id);
            r = getElementById(attObj.id);
        } else if (ua.webkit && ua.webkit < 312) {
            var e = createElement("embed");
            e.setAttribute("type", FLASH_MIME_TYPE);
            for (var k in attObj) {
                if (attObj[k] != Object.prototype[k]) {
                    if (k == "data") {
                        e.setAttribute("src", attObj[k]);
                    } else if (k.toLowerCase() == "styleclass") {
                        e.setAttribute("class", attObj[k]);
                    } else if (k != "classid") {
                        e.setAttribute(k, attObj[k]);
                    }
                }
            }
            for (var l in parObj) {
                if (parObj[l] != Object.prototype[l]) {
                    if (l != "movie") {
                        e.setAttribute(l, parObj[l]);
                    }
                }
            }
            el.parentNode.replaceChild(e, el);
            r = e;
        } else {
            var o = createElement(OBJECT);
            o.setAttribute("type", FLASH_MIME_TYPE);
            for (var m in attObj) {
                if (attObj[m] != Object.prototype[m]) {
                    if (m.toLowerCase() == "styleclass") {
                        o.setAttribute("class", attObj[m]);
                    } else if (m != "classid") {
                        o.setAttribute(m, attObj[m]);
                    }
                }
            }
            for (var n in parObj) {
                if (parObj[n] != Object.prototype[n] && n != "movie") {
                    createObjParam(o, n, parObj[n]);
                }
            }
            el.parentNode.replaceChild(o, el);
            r = o;
        }
        return r;
    }

    function createObjParam(el, pName, pValue) {
        var p = createElement("param");
        p.setAttribute("name", pName);
        p.setAttribute("value", pValue);
        el.appendChild(p);
    }

    function getElementById(id) {
        return doc.getElementById(id);
    }

    function createElement(el) {
        return doc.createElement(el);
    }

    function hasPlayerVersion(rv) {
        var pv = ua.pv,
            v = rv.split(".");
        v[0] = parseInt(v[0], 10);
        v[1] = parseInt(v[1], 10);
        v[2] = parseInt(v[2], 10);
        return (pv[0] > v[0] || (pv[0] == v[0] && pv[1] > v[1]) || (pv[0] == v[0] && pv[1] == v[1] && pv[2] >= v[2])) ? true : false;
    }

    function createCSS(sel, decl) {
        if (ua.ie && ua.mac) {
            return;
        }
        var h = doc.getElementsByTagName("head")[0],
            s = createElement("style");
        s.setAttribute("type", "text/css");
        s.setAttribute("media", "screen");
        if (!(ua.ie && ua.win) && typeof doc.createTextNode != UNDEF) {
            s.appendChild(doc.createTextNode(sel + " {" + decl + "}"));
        }
        h.appendChild(s);
        if (ua.ie && ua.win && typeof doc.styleSheets != UNDEF && doc.styleSheets.length > 0) {
            var ls = doc.styleSheets[doc.styleSheets.length - 1];
            if (typeof ls.addRule == OBJECT) {
                ls.addRule(sel, decl);
            }
        }
    }

    function setVisibility(id, isVisible) {
        var v = isVisible ? "inherit" : "hidden";
        if (isDomLoaded) {
            getElementById(id).style.visibility = v;
        } else {
            createCSS("#" + id, "visibility:" + v);
        }
    }

    function getTargetVersion(obj) {
        if (!obj)
            return 0;
        var c = obj.childNodes;
        var cl = c.length;
        for (var i = 0; i < cl; i++) {
            if (c[i].nodeType == 1 && c[i].nodeName.toLowerCase() == "object") {
                c = c[i].childNodes;
                cl = c.length;
                i = 0;
            }
            if (c[i].nodeType == 1 && c[i].nodeName.toLowerCase() == "param" && c[i].getAttribute("name") == "swfversion") {
                return c[i].getAttribute("value");
            }
        }
        return 0;
    }

    function getExpressInstall(obj) {
        if (!obj)
            return "";
        var c = obj.childNodes;
        var cl = c.length;
        for (var i = 0; i < cl; i++) {
            if (c[i].nodeType == 1 && c[i].nodeName.toLowerCase() == "object") {
                c = c[i].childNodes;
                cl = c.length;
                i = 0;
            }
            if (c[i].nodeType == 1 && c[i].nodeName.toLowerCase() == "param" && c[i].getAttribute("name") == "expressinstall") {
                return c[i].getAttribute("value");
            }
        }
        return "";
    }
    return {
        registerObject: function(objectIdStr, swfVersionStr, xiSwfUrlStr) {
            if (!ua.w3cdom || !objectIdStr) {
                return;
            }
            var obj = document.getElementById(objectIdStr);
            var xi = getExpressInstall(obj);
            var regObj = {};
            regObj.id = objectIdStr;
            regObj.swfVersion = swfVersionStr ? swfVersionStr : getTargetVersion(obj);
            regObj.expressInstall = xiSwfUrlStr ? xiSwfUrlStr : ((xi != "") ? xi : false);
            regObjArr[regObjArr.length] = regObj;
            setVisibility(objectIdStr, false);
        },
        getObjectById: function(objectIdStr) {
            var r = null;
            if (ua.w3cdom && isDomLoaded) {
                var o = getElementById(objectIdStr);
                if (o) {
                    var n = o.getElementsByTagName(OBJECT)[0];
                    if (!n || (n && typeof o.SetVariable != UNDEF)) {
                        r = o;
                    } else if (typeof n.SetVariable != UNDEF) {
                        r = n;
                    }
                }
            }
            return r;
        },
        embedSWF: function(swfUrlStr, replaceElemIdStr, widthStr, heightStr, swfVersionStr, xiSwfUrlStr, flashvarsObj, parObj, attObj) {
            if (!ua.w3cdom || !swfUrlStr || !replaceElemIdStr || !widthStr || !heightStr || !swfVersionStr) {
                return;
            }
            widthStr += "";
            heightStr += "";
            if (hasPlayerVersion(swfVersionStr)) {
                setVisibility(replaceElemIdStr, false);
                var att = (typeof attObj == OBJECT) ? attObj : {};
                att.data = swfUrlStr;
                att.width = widthStr;
                att.height = heightStr;
                var par = (typeof parObj == OBJECT) ? parObj : {};
                if (typeof flashvarsObj == OBJECT) {
                    for (var i in flashvarsObj) {
                        if (flashvarsObj[i] != Object.prototype[i]) {
                            if (typeof par.flashvars != UNDEF) {
                                par.flashvars += "&" + i + "=" + flashvarsObj[i];
                            } else {
                                par.flashvars = i + "=" + flashvarsObj[i];
                            }
                        }
                    }
                }
                addDomLoadEvent(function() {
                    createSWF(att, par, replaceElemIdStr);
                    if (att.id == replaceElemIdStr) {
                        setVisibility(replaceElemIdStr, true);
                    }
                });
            } else if (xiSwfUrlStr && !isExpressInstallActive && hasPlayerVersion("6.0.65") && (ua.win || ua.mac)) {
                setVisibility(replaceElemIdStr, false);
                addDomLoadEvent(function() {
                    var regObj = {};
                    regObj.id = regObj.altContentId = replaceElemIdStr;
                    regObj.width = widthStr;
                    regObj.height = heightStr;
                    regObj.expressInstall = xiSwfUrlStr;
                    showExpressInstall(regObj);
                });
            }
        },
        getFlashPlayerVersion: function() {
            return {
                major: ua.pv[0],
                minor: ua.pv[1],
                release: ua.pv[2]
            };
        },
        hasFlashPlayerVersion: hasPlayerVersion,
        createSWF: function(attObj, parObj, replaceElemIdStr) {
            if (ua.w3cdom && isDomLoaded) {
                return createSWF(attObj, parObj, replaceElemIdStr);
            } else {
                return undefined;
            }
        },
        createCSS: function(sel, decl) {
            if (ua.w3cdom) {
                createCSS(sel, decl);
            }
        },
        addDomLoadEvent: addDomLoadEvent,
        addLoadEvent: addLoadEvent,
        getQueryParamValue: function(param) {
            var q = doc.location.search || doc.location.hash;
            if (param == null) {
                return q;
            }
            if (q) {
                var pairs = q.substring(1).split("&");
                for (var i = 0; i < pairs.length; i++) {
                    if (pairs[i].substring(0, pairs[i].indexOf("=")) == param) {
                        return pairs[i].substring((pairs[i].indexOf("=") + 1));
                    }
                }
            }
            return "";
        },
        expressInstallCallback: function() {
            if (isExpressInstallActive && storedAltContent) {
                var obj = getElementById(EXPRESS_INSTALL_ID);
                if (obj) {
                    obj.parentNode.replaceChild(storedAltContent, obj);
                    if (storedAltContentId) {
                        setVisibility(storedAltContentId, true);
                        if (ua.ie && ua.win) {
                            storedAltContent.style.display = "block";
                        }
                    }
                    storedAltContent = null;
                    storedAltContentId = null;
                    isExpressInstallActive = false;
                }
            }
        }
    };
}();;
$.fn.tabs = function() {
    var selector = this;
    this.each(function() {
        var obj = $(this);
        $(obj.attr('href')).hide();
        obj.click(function() {
            $(selector).removeClass('selected');
            $(this).addClass('selected');
            $($(this).attr('href')).fadeIn();
            $(selector).not(this).each(function(i, element) {
                $($(element).attr('href')).hide();
            });
            return false;
        });
    });
    $(this).show();
    $(this).first().click();
};;
(function(a, b, c) {
    function Z(c, d, e) {
        var g = b.createElement(c);
        return d && (g.id = f + d), e && (g.style.cssText = e), a(g)
    }

    function $(a) {
        var b = y.length,
            c = (Q + a) % b;
        return c < 0 ? b + c : c
    }

    function _(a, b) {
        return Math.round((/%/.test(a) ? (b === "x" ? z.width() : z.height()) / 100 : 1) * parseInt(a, 10))
    }

    function ba(a) {
        return K.photo || /\.(gif|png|jpe?g|bmp|ico)((#|\?).*)?$/i.test(a)
    }

    function bb() {
        var b;
        K = a.extend({}, a.data(P, e));
        for (b in K) a.isFunction(K[b]) && b.slice(0, 2) !== "on" && (K[b] = K[b].call(P));
        K.rel = K.rel || P.rel || "nofollow", K.href = K.href || a(P).attr("href"), K.title = K.title || P.title, typeof K.href == "string" && (K.href = a.trim(K.href))
    }

    function bc(b, c) {
        a.event.trigger(b), c && c.call(P)
    }

    function bd() {
        var a, b = f + "Slideshow_",
            c = "click." + f,
            d, e, g;
        K.slideshow && y[1] ? (d = function() {
            F.text(K.slideshowStop).unbind(c).bind(j, function() {
                if (K.loop || y[Q + 1]) a = setTimeout(W.next, K.slideshowSpeed)
            }).bind(i, function() {
                clearTimeout(a)
            }).one(c + " " + k, e), r.removeClass(b + "off").addClass(b + "on"), a = setTimeout(W.next, K.slideshowSpeed)
        }, e = function() {
            clearTimeout(a), F.text(K.slideshowStart).unbind([j, i, k, c].join(" ")).one(c, function() {
                W.next(), d()
            }), r.removeClass(b + "on").addClass(b + "off")
        }, K.slideshowAuto ? d() : e()) : r.removeClass(b + "off " + b + "on")
    }

    function be(b) {
        U || (P = b, bb(), y = a(P), Q = 0, K.rel !== "nofollow" && (y = a("." + g).filter(function() {
            var b = a.data(this, e).rel || this.rel;
            return b === K.rel
        }), Q = y.index(P), Q === -1 && (y = y.add(P), Q = y.length - 1)), S || (S = T = !0, r.show(), K.returnFocus && a(P).blur().one(l, function() {
            a(this).focus()
        }), q.css({
            opacity: +K.opacity,
            cursor: K.overlayClose ? "pointer" : "auto"
        }).show(), K.w = _(K.initialWidth, "x"), K.h = _(K.initialHeight, "y"), W.position(), o && z.bind("resize." + p + " scroll." + p, function() {
            q.css({
                width: z.width(),
                height: z.height(),
                top: z.scrollTop(),
                left: z.scrollLeft()
            })
        }).trigger("resize." + p), bc(h, K.onOpen), J.add(D).hide(), I.html(K.close).show()), W.load(!0))
    }

    function bf() {
        !r && b.body && (Y = !1, z = a(c), r = Z(X).attr({
            id: e,
            "class": n ? f + (o ? "IE6" : "IE") : ""
        }).hide(), q = Z(X, "Overlay", o ? "position:absolute" : "").hide(), s = Z(X, "Wrapper"), t = Z(X, "Content").append(A = Z(X, "LoadedContent", "width:0; height:0; overflow:hidden"), C = Z(X, "LoadingOverlay").add(Z(X, "LoadingGraphic")), D = Z(X, "Title"), E = Z(X, "Current"), G = Z(X, "Next"), H = Z(X, "Previous"), F = Z(X, "Slideshow").bind(h, bd), I = Z(X, "Close")), s.append(Z(X).append(Z(X, "TopLeft"), u = Z(X, "TopCenter"), Z(X, "TopRight")), Z(X, !1, "clear:left").append(v = Z(X, "MiddleLeft"), t, w = Z(X, "MiddleRight")), Z(X, !1, "clear:left").append(Z(X, "BottomLeft"), x = Z(X, "BottomCenter"), Z(X, "BottomRight"))).find("div div").css({
            "float": "left"
        }), B = Z(X, !1, "position:absolute; width:9999px; visibility:hidden; display:none"), J = G.add(H).add(E).add(F), a(b.body).append(q, r.append(s, B)))
    }

    function bg() {
        return r ? (Y || (Y = !0, L = u.height() + x.height() + t.outerHeight(!0) - t.height(), M = v.width() + w.width() + t.outerWidth(!0) - t.width(), N = A.outerHeight(!0), O = A.outerWidth(!0), r.css({
            "padding-bottom": L,
            "padding-right": M
        }), G.click(function() {
            W.next()
        }), H.click(function() {
            W.prev()
        }), I.click(function() {
            W.close()
        }), q.click(function() {
            K.overlayClose && W.close()
        }), a(b).bind("keydown." + f, function(a) {
            var b = a.keyCode;
            S && K.escKey && b === 27 && (a.preventDefault(), W.close()), S && K.arrowKey && y[1] && (b === 37 ? (a.preventDefault(), H.click()) : b === 39 && (a.preventDefault(), G.click()))
        }), a("." + g, b).live("click", function(a) {
            a.which > 1 || a.shiftKey || a.altKey || a.metaKey || (a.preventDefault(), be(this))
        })), !0) : !1
    }
    var d = {
        transition: "elastic",
        speed: 300,
        width: !1,
        initialWidth: "600",
        innerWidth: !1,
        maxWidth: !1,
        height: !1,
        initialHeight: "450",
        innerHeight: !1,
        maxHeight: !1,
        scalePhotos: !0,
        scrolling: !0,
        inline: !1,
        html: !1,
        iframe: !1,
        fastIframe: !0,
        photo: !1,
        href: !1,
        title: !1,
        rel: !1,
        opacity: .9,
        preloading: !0,
        current: "image {current} of {total}",
        previous: "previous",
        next: "next",
        close: "close",
        open: !1,
        returnFocus: !0,
        reposition: !0,
        loop: !0,
        slideshow: !1,
        slideshowAuto: !0,
        slideshowSpeed: 2500,
        slideshowStart: "start slideshow",
        slideshowStop: "stop slideshow",
        onOpen: !1,
        onLoad: !1,
        onComplete: !1,
        onCleanup: !1,
        onClosed: !1,
        overlayClose: !0,
        escKey: !0,
        arrowKey: !0,
        top: !1,
        bottom: !1,
        left: !1,
        right: !1,
        fixed: !1,
        data: undefined
    }, e = "colorbox",
        f = "cbox",
        g = f + "Element",
        h = f + "_open",
        i = f + "_load",
        j = f + "_complete",
        k = f + "_cleanup",
        l = f + "_closed",
        m = f + "_purge",
        n = !a.support.opacity && !a.support.style,
        o = n && !c.XMLHttpRequest,
        p = f + "_IE6",
        q, r, s, t, u, v, w, x, y, z, A, B, C, D, E, F, G, H, I, J, K, L, M, N, O, P, Q, R, S, T, U, V, W, X = "div",
        Y;
    if (a.colorbox) return;
    a(bf), W = a.fn[e] = a[e] = function(b, c) {
        var f = this;
        b = b || {}, bf();
        if (bg()) {
            if (!f[0]) {
                if (f.selector) return f;
                f = a("<a/>"), b.open = !0
            }
            c && (b.onComplete = c), f.each(function() {
                a.data(this, e, a.extend({}, a.data(this, e) || d, b))
            }).addClass(g), (a.isFunction(b.open) && b.open.call(f) || b.open) && be(f[0])
        }
        return f
    }, W.position = function(a, b) {
        function i(a) {
            u[0].style.width = x[0].style.width = t[0].style.width = a.style.width, t[0].style.height = v[0].style.height = w[0].style.height = a.style.height
        }
        var c = 0,
            d = 0,
            e = r.offset(),
            g = z.scrollTop(),
            h = z.scrollLeft();
        z.unbind("resize." + f), r.css({
            top: -9e4,
            left: -9e4
        }), K.fixed && !o ? (e.top -= g, e.left -= h, r.css({
            position: "fixed"
        })) : (c = g, d = h, r.css({
            position: "absolute"
        })), K.right !== !1 ? d += Math.max(z.width() - K.w - O - M - _(K.right, "x"), 0) : K.left !== !1 ? d += _(K.left, "x") : d += Math.round(Math.max(z.width() - K.w - O - M, 0) / 2), K.bottom !== !1 ? c += Math.max(z.height() - K.h - N - L - _(K.bottom, "y"), 0) : K.top !== !1 ? c += _(K.top, "y") : c += Math.round(Math.max(z.height() - K.h - N - L, 0) / 2), r.css({
            top: e.top,
            left: e.left
        }), a = r.width() === K.w + O && r.height() === K.h + N ? 0 : a || 0, s[0].style.width = s[0].style.height = "9999px", r.dequeue().animate({
            width: K.w + O,
            height: K.h + N,
            top: c,
            left: d
        }, {
            duration: a,
            complete: function() {
                i(this), T = !1, s[0].style.width = K.w + O + M + "px", s[0].style.height = K.h + N + L + "px", K.reposition && setTimeout(function() {
                    z.bind("resize." + f, W.position)
                }, 1), b && b()
            },
            step: function() {
                i(this)
            }
        })
    }, W.resize = function(a) {
        S && (a = a || {}, a.width && (K.w = _(a.width, "x") - O - M), a.innerWidth && (K.w = _(a.innerWidth, "x")), A.css({
            width: K.w
        }), a.height && (K.h = _(a.height, "y") - N - L), a.innerHeight && (K.h = _(a.innerHeight, "y")), !a.innerHeight && !a.height && (A.css({
            height: "auto"
        }), K.h = A.height()), A.css({
            height: K.h
        }), W.position(K.transition === "none" ? 0 : K.speed))
    }, W.prep = function(b) {
        function g() {
            return K.w = K.w || A.width(), K.w = K.mw && K.mw < K.w ? K.mw : K.w, K.w
        }

        function h() {
            return K.h = K.h || A.height(), K.h = K.mh && K.mh < K.h ? K.mh : K.h, K.h
        }
        if (!S) return;
        var c, d = K.transition === "none" ? 0 : K.speed;
        A.remove(), A = Z(X, "LoadedContent").append(b), A.hide().appendTo(B.show()).css({
            width: g(),
            overflow: K.scrolling ? "auto" : "hidden"
        }).css({
            height: h()
        }).prependTo(t), B.hide(), a(R).css({
            "float": "none"
        }), o && a("select").not(r.find("select")).filter(function() {
            return this.style.visibility !== "hidden"
        }).css({
            visibility: "hidden"
        }).one(k, function() {
            this.style.visibility = "inherit"
        }), c = function() {
            function q() {
                n && r[0].style.removeAttribute("filter")
            }
            var b, c, g = y.length,
                h, i = "frameBorder",
                k = "allowTransparency",
                l, o, p;
            if (!S) return;
            l = function() {
                clearTimeout(V), C.hide(), bc(j, K.onComplete)
            }, n && R && A.fadeIn(100), D.html(K.title).add(A).show();
            if (g > 1) {
                typeof K.current == "string" && E.html(K.current.replace("{current}", Q + 1).replace("{total}", g)).show(), G[K.loop || Q < g - 1 ? "show" : "hide"]().html(K.next), H[K.loop || Q ? "show" : "hide"]().html(K.previous), K.slideshow && F.show();
                if (K.preloading) {
                    b = [$(-1), $(1)];
                    while (c = y[b.pop()]) o = a.data(c, e).href || c.href, a.isFunction(o) && (o = o.call(c)), ba(o) && (p = new Image, p.src = o)
                }
            } else J.hide();
            K.iframe ? (h = Z("iframe")[0], i in h && (h[i] = 0), k in h && (h[k] = "true"), h.name = f + +(new Date), K.fastIframe ? l() : a(h).one("load", l), h.src = K.href, K.scrolling || (h.scrolling = "no"), a(h).addClass(f + "Iframe").appendTo(A).one(m, function() {
                h.src = "//about:blank"
            })) : l(), K.transition === "fade" ? r.fadeTo(d, 1, q) : q()
        }, K.transition === "fade" ? r.fadeTo(d, 0, function() {
            W.position(0, c)
        }) : W.position(d, c)
    }, W.load = function(b) {
        var c, d, e = W.prep;
        T = !0, R = !1, P = y[Q], b || bb(), bc(m), bc(i, K.onLoad), K.h = K.height ? _(K.height, "y") - N - L : K.innerHeight && _(K.innerHeight, "y"), K.w = K.width ? _(K.width, "x") - O - M : K.innerWidth && _(K.innerWidth, "x"), K.mw = K.w, K.mh = K.h, K.maxWidth && (K.mw = _(K.maxWidth, "x") - O - M, K.mw = K.w && K.w < K.mw ? K.w : K.mw), K.maxHeight && (K.mh = _(K.maxHeight, "y") - N - L, K.mh = K.h && K.h < K.mh ? K.h : K.mh), c = K.href, V = setTimeout(function() {
            C.show()
        }, 100), K.inline ? (Z(X).hide().insertBefore(a(c)[0]).one(m, function() {
            a(this).replaceWith(A.children())
        }), e(a(c))) : K.iframe ? e(" ") : K.html ? e(K.html) : ba(c) ? (a(R = new Image).addClass(f + "Photo").error(function() {
            K.title = !1, e(Z(X, "Error").text("This image could not be loaded"))
        }).load(function() {
            var a;
            R.onload = null, K.scalePhotos && (d = function() {
                R.height -= R.height * a, R.width -= R.width * a
            }, K.mw && R.width > K.mw && (a = (R.width - K.mw) / R.width, d()), K.mh && R.height > K.mh && (a = (R.height - K.mh) / R.height, d())), K.h && (R.style.marginTop = Math.max(K.h - R.height, 0) / 2 + "px"), y[1] && (K.loop || y[Q + 1]) && (R.style.cursor = "pointer", R.onclick = function() {
                W.next()
            }), n && (R.style.msInterpolationMode = "bicubic"), setTimeout(function() {
                e(R)
            }, 1)
        }), setTimeout(function() {
            R.src = c
        }, 1)) : c && B.load(c, K.data, function(b, c, d) {
            e(c === "error" ? Z(X, "Error").text("Request unsuccessful: " + d.statusText) : a(this).contents())
        })
    }, W.next = function() {
        !T && y[1] && (K.loop || y[Q + 1]) && (Q = $(1), W.load())
    }, W.prev = function() {
        !T && y[1] && (K.loop || Q) && (Q = $(-1), W.load())
    }, W.close = function() {
        S && !U && (U = !0, S = !1, bc(k, K.onCleanup), z.unbind("." + f + " ." + p), q.fadeTo(200, 0), r.stop().fadeTo(300, 0, function() {
            r.add(q).css({
                opacity: 1,
                cursor: "auto"
            }).hide(), bc(m), A.remove(), setTimeout(function() {
                U = !1, bc(l, K.onClosed)
            }, 1)
        }))
    }, W.remove = function() {
        a([]).add(r).add(q).remove(), r = null, a("." + g).removeData(e).removeClass(g).die()
    }, W.element = function() {
        return a(P)
    }, W.settings = d
})(jQuery, document, this);
