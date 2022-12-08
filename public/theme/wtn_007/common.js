function setPageBg(e) {
    e != page.slug && (page.slug && bg[page.slug].leave(), bg[e].init(), page.slug = e)
}

window.addEventListener("load", function() {
    setTimeout(function() {
        document.body.classList.add("loaded"), isLoading = !1, loading.stop(), loadingAfterFunc()
    }, 3e3), component.globalNav($(".barba-container").data("namespace")), page.init(), prettyPrint()
});

var resizeTimer;
"sp" != getDevice ? window.addEventListener("resize", function() {
    clearTimeout(resizeTimer), resizeTimer = setTimeout(function() {
        bg.resize()
    }, 500)
}) : window.addEventListener("orientationchange", function() {
    clearTimeout(resizeTimer), resizeTimer = setTimeout(function() {
        bg.resize()
    }, 500)
}), Barba.Pjax.start(), Barba.Prefetch.init(), Barba.Dispatcher.on("linkClicked", function(e, t, n, o) {
    $("html,body").scrollTop(0), e.dataset.pagechange && (document.body.classList.remove("changed-" + page.pagechange), page.pagechange = e.dataset.pagechange, document.body.classList.add("change-" + page.pagechange))
}), Barba.Dispatcher.on("transitionCompleted", function(e, t, n, o) {
    $("html").removeClass("open"), page.pagechange && (document.body.classList.remove("change-" + page.pagechange), document.body.classList.add("changed-" + page.pagechange))
}), Barba.Dispatcher.on("newPageReady", function(e, t, n, o) {
    var i = document.head,
        a = o.match(/<head[^>]*>([\s\S.]*)<\/head>/i)[0],
        r = document.createElement("head");
    r.innerHTML = a;
    for (var s = ["meta[name='keywords']", "meta[name='description']", "meta[property^='og']", "meta[name^='twitter']", "meta[itemprop]", "link[itemprop]", "link[rel='prev']", "link[rel='next']", "link[rel='canonical']"].join(","), c = i.querySelectorAll(s), l = 0; l < c.length; l++) i.removeChild(c[l]);
    for (var d = r.querySelectorAll(s), l = 0; l < d.length; l++) i.appendChild(d[l]);
    page.show(), $(window).off(".noScroll"), prettyPrint()
});
var bg = function() {
        var e = !1,
            t = new THREE.Scene,
            n = $("#bgCanvas").outerHeight(),
            o = window.innerHeight;
        n > o && (o = n);
        var i = new THREE.OrthographicCamera(window.innerWidth / -10, window.innerWidth / 10, o / 10, o / -10, 0, 100);
        i.position.z = 10, "sp" == getDevice && (i.zoom = .5), i.updateProjectionMatrix();
        var a = new THREE.WebGLRenderer({
            alpha: !0,
            antialias: !0,
            canvas: document.getElementById("bgCanvas")
        });
        a.setSize(window.innerWidth, o), "sp" == getDevice && a.setPixelRatio(window.devicePixelRatio || 1), document.getElementById("bg").appendChild(a.domElement);
        var r = new THREE.Raycaster,
            s = new THREE.Vector2,
            c = function(t) {
                s.x = t.clientX / window.innerWidth * 2 - 1, s.y = 2 * -(t.clientY / window.innerHeight) + 1, e = !0
            };
        "sp" != getDevice && window.addEventListener("mousemove", c.bind(this), !1), window.addEventListener("blur", function() {
            e = !0
        }, !1);
        var l = function() {},
            d = function() {
                requestAnimationFrame(d.bind(this)), e && (r.setFromCamera(s, i), l(), a.render(t, i), e = !1), s.x = -4e3, s.y = -4e3
            },
            m = new THREE.TextureLoader,
            u = {
               
            };
       // u.home.minFilter = THREE.LinearFilter, u.home.magFilter = THREE.LinearFilter, u.release.minFilter = THREE.LinearFilter, u.release.magFilter = THREE.LinearFilter, u.about.minFilter = THREE.LinearFilter, u.about.magFilter = THREE.LinearFilter, u.works.minFilter = THREE.LinearFilter, u.works.magFilter = THREE.LinearFilter, u.contact.minFilter = THREE.LinearFilter, u.contact.magFilter = THREE.LinearFilter;
        var p = {
            home: new THREE.Object3D,
            release: new THREE.Object3D,
            works: new THREE.Object3D,
            about: new THREE.Object3D,
            contact: new THREE.Object3D
        };
        p.home.name = "home", p.release.name = "release", p.works.name = "works", p.about.name = "about", p.contact.name = "contact";
        var h, g = function(t) {
                t.scale.set(.01, .01, .01), (new TimelineMax).to(t.scale, 1, {
                    x: 1,
                    y: 1,
                    z: 1,
                    ease: Cubic.easeInOut,
                    delay: .5,
                    onUpdate: function() {
                        e = !0
                    }
                }, 0)
            },
            f = function(n, o, i) {
                for (var r = n.length, s = 0; s < r; s++) {
                    (new TimelineMax).to(n[s].scale, 1, {
                        x: .05,
                        y: .05,
                        z: .05,
                        ease: Cubic.easeInOut,
                        onUpdate: function() {
                            e = !0
                        }
                    })
                }
                setTimeout(function() {
                    t.remove(t.getObjectByName(o));
                    for (var e = 0; e < p[o].children.length; e++) {
                        for (var n = p[o].children[e].children, r = 0; r < n.length; r++) t.remove(n[r].mesh), n[r].geometry && n[r].geometry.dispose(), n[r].material && n[r].material.dispose(), a.dispose(n[r].mesh), a.dispose(n[r].geometry), a.dispose(n[r].material);
                        n.length = 0
                    }
                    p[o].children.length = 0, i && i()
                }, 1e3)
            },
            w = function() {};
        return {
            init: function() {
                d()
            },
            resize: function() {
                clearTimeout(h), h = setTimeout(function() {
                    w(), i.left = window.innerWidth / -10, i.right = window.innerWidth / 10, i.top = window.innerHeight / 10, i.bottom = window.innerHeight / -10, i.updateProjectionMatrix(), a.setSize(window.innerWidth, window.innerHeight)
                }, 50)
            },
            home: {
                init: function() {
                    this.create(), l = this.hover.bind(this), w = this.resize.bind(this)
                },
                resize: function() {
                    f(p.home.children, "home", this.create)
                },
                create: function() {
                    var e = Math.ceil(window.innerWidth / 110) + 1,
                        n = Math.ceil(window.innerHeight / 63);
                    "sp" == getDevice && (e *= 2, n *= 2);
                    for (var o = Math.floor(e * n), i = {
                            w: 24.4,
                            h: 28.4
                        }, a = 0, r = 0, s = 0; a < o; a++, s++) {
                        var c = new THREE.PlaneBufferGeometry(i.w, i.h, 2),
                            l = new THREE.MeshBasicMaterial({
                                map: u.home,
                                transparent: !0
                            }),
                            d = new THREE.Mesh(c, l),
                            m = 0;
                        r % 2 == 0 && (m = -i.w / 2), d.position.x = s * i.w + m, d.position.y = r * (.74 * i.h), s >= e && (s = 0, r++), g(d), p.home.add(d)
                    }
                    t.add(p.home), p.home.name = "home", p.home.position.x = -1 * (i.w * e / 2), p.home.position.y = -1 * (.7 * i.h * n / 2)
                },
                hover: function() {
                    var e = r.intersectObjects(p.home.children, !0);
                    if (e.length < 10)
                        for (var t = 0; t < e.length; t++) this.action(e[t].object)
                },
                action: function(t) {
                    if (!t.isAnimation) {
                        t.isAnimation = !0, t.position.z = .1;
                        var n = t.position.y + 10;
                        new TimelineMax({
                            yoyo: !0,
                            repeat: 1,
                            repeatDelay: 0
                        }).to(t.position, .2, {
                            y: n,
                            ease: Cubic.easeInOut,
                            onUpdate: function() {
                                e = !0
                            },
                            onComplete: function() {
                                setTimeout(function() {
                                    t.isAnimation = !1, t.position.z = 0
                                }, 500)
                            }
                        }, 0)
                    }
                },
                leave: function() {
                    f(p.home.children, "home")
                }
            },
            release: {
                init: function() {
                    this.create(), w = this.resize.bind(this), l = this.hover.bind(this)
                },
                resize: function() {
                    f(p.release.children, "release", this.create)
                },
                create: function() {
                    var e = Math.floor(window.innerWidth / 90) + 3,
                        n = Math.floor(window.innerHeight / 70) + 3;
                    "sp" == getDevice && (e *= 2, n *= 2);
                    for (var o = Math.floor(e * n), i = {
                            w: 33,
                            h: 28.5
                        }, a = 0, r = 0, s = 0; a < o; a++, s++) {
                        var c = new THREE.PlaneBufferGeometry(i.w, i.h, 2),
                            l = new THREE.MeshBasicMaterial({
                                map: u.release,
                                transparent: !0
                            }),
                            d = new THREE.Mesh(c, l),
                            m = 0;
                        r % 2 == 0 && (m = .74 * i.w / 2), d.position.x = s * (.74 * i.w) + m, d.position.y = r * (.74 * i.h), s > e && (s = 0, r++), g(d), p.release.add(d)
                    }
                    t.add(p.release), p.release.name = "releaseBlock", p.release.position.x = -1 * i.w * e / 2, p.release.position.y = -1 * i.h * .73 * n / 2
                },
                vertices: [],
                hover: function() {
                    var e = r.intersectObjects(p.release.children, !0);
                    if (e.length < 10)
                        for (var t = 0; t < e.length; t++) this.action(e[t].object)
                },
                action: function(t) {
                    if (!t.isAnimation) {
                        t.isAnimation = !0;
                        var n = new TimelineMax;
                        t.rotation.z = 0, n.to(t.rotation, .5, {
                            z: Math.PI / 180 * 120,
                            ease: Cubic.easeInOut,
                            onUpdate: function() {
                                e = !0
                            },
                            onComplete: function() {
                                setTimeout(function() {
                                    t.isAnimation = !1
                                }, 50)
                            }
                        })
                    }
                },
                leave: function() {
                    f(p.release.children, "release")
                }
            },
            about: {
                init: function() {
                    this.create(), l = this.hover.bind(this), w = this.resize.bind(this), this.bakuClickSetting(), this.bakuImageLoading || (this.bakuImageLoad(), this.bakuImageLoading = !0), app = {
                        text: "これまでにないアイデアで、これまでにない喜びを",
                        index: 0,
                        chars: 0,
                        speed: 100,
                        container: ".text .content",
                        init: function() {
                            return this.chars = this.text.length, setTimeout(function() {
                                $(".text").addClass("aniEnd")
                            }, this.speed * this.text.length), this.write()
                        },
                        write: function() {
                            if ($(this.container).append(this.text[this.index]), this.index < this.chars) return this.index++, window.setTimeout(function() {
                                return app.write()
                            }, this.speed)
                        }
                    };
                    var e = 500;
                    isLoading && (e = 3500), setTimeout(function() {
                        app.init()
                    }, e)
                },
                bakuImageLoading: !1,
                resize: function() {
                    f(p.about.children, "about", this.create)
                },
                bakuImageLoad: function() {
                    for (var e = 0; e < 6; e++) {
                        var t = new Image;
                        t.onload = function() {}, t.src = wp_path + "images/anime_0" + (e + 1) + "-min.png"
                    }
                },
                bakuClickCount: 0,
                bakuClickSetting: function() {
                    var e = $(".baku");
                    this.bakuClickCount = 0, e.off("click", this.bakuClick.bind(this)), e.on("click", this.bakuClick.bind(this))
                },
                bakuAnimationFlg: !1,
                bakuClick: function() {
                    if (!this.bakuAnimationFlg && (1 == ++this.bakuClickCount || 3 == this.bakuClickCount || 5 == this.bakuClickCount)) {
                        this.bakuAnimationFlg = !0;
                        var e = this;
                        $(".baku").attr("class", "baku step" + this.bakuClickCount).on({
                            webkitAnimationEnd: function() {
                                e.bakuAnimationFlg = !1, 1 != e.bakuClickCount && 3 != e.bakuClickCount && 5 != e.bakuClickCount || (e.bakuClickCount++, e.bakuClickCount >= 6 && (e.bakuClickCount = 0), $(".baku").attr("class", "baku step" + e.bakuClickCount))
                            },
                            animationend: function() {
                                e.bakuAnimationFlg = !1, 1 != e.bakuClickCount && 3 != e.bakuClickCount && 5 != e.bakuClickCount || (e.bakuClickCount++, e.bakuClickCount >= 6 && (e.bakuClickCount = 0), $(".baku").attr("class", "baku step" + e.bakuClickCount))
                            }
                        })
                    }
                },
                create: function() {
                    var e = Math.ceil(window.innerWidth / 100) + 1,
                        n = Math.ceil(window.innerHeight / 70) + 2;
                    "sp" == getDevice && (e *= 2, n *= 2);
                    for (var o = Math.floor(e * n), i = {
                            w: 36.2,
                            h: 42.3
                        }, a = 0, r = 0, s = 0; a < o; a++, s++) {
                        var c = new THREE.Object3D,
                            l = new THREE.CircleBufferGeometry(12.25, 30);
                        l.center();
                        var d = new THREE.MeshBasicMaterial({
                                color: 16777215,
                                transparent: !0
                            }),
                            m = new THREE.Mesh(l, d);
                        m.position.x -= .3, m.name = "aboutObject", c.add(m);
                        var l = new THREE.PlaneBufferGeometry(i.w, i.h, 2),
                            d = new THREE.MeshBasicMaterial({
                                map: u.about,
                                transparent: !0
                            }),
                            h = new THREE.Mesh(l, d),
                            f = 0;
                        r % 2 == 0 && (f = .6755 * i.w / 2), c.add(h), c.position.x = s * (.6755 * i.w) + f, c.position.y = r * (.4999999 * i.h), s > e && (s = 0, r++), g(c), p.about.add(c)
                    }
                    t.add(p.about), p.about.name = "about", p.about.position.x = -1 * i.w * .6755 * e / 2, p.about.position.y = -1 * i.h * .4999999 * n / 2
                },
                hover: function() {
                    var e = r.intersectObjects(p.about.children, !0);
                    if (e.length < 10)
                        for (var t = 0; t < e.length; t++) "aboutObject" == e[t].object.name && this.action(e[t].object)
                },
                action: function(t) {
                    if (!t.isAnimation) {
                        t.isAnimation = !0;
                        new TimelineMax({
                            yoyo: !0,
                            repeat: 1,
                            repeatDelay: 0
                        }).to(t.scale, .4, {
                            x: 0,
                            y: 0,
                            z: 0,
                            ease: Power1.easeIn,
                            onUpdate: function() {
                                e = !0
                            },
                            onComplete: function() {
                                setTimeout(function() {
                                    t.isAnimation = !1
                                }, 500)
                            }
                        }, 0)
                    }
                },
                leave: function() {
                    $(".concept").empty(), $(".text").removeClass("aniEnd"), f(p.about.children, "about")
                }
            },
            works: {
                init: function() {
                    this.create(), l = this.hover.bind(this), w = this.resize.bind(this)
                },
                resize: function() {
                    f(p.works.children, "works", this.create)
                },
                create: function() {
                    var e = Math.ceil(window.innerWidth / 55) + 2,
                        n = Math.ceil(window.innerHeight / 100) + 3;
                    "sp" == getDevice && (e *= 2, n *= 2);
                    for (var o = Math.floor(e * n), i = {
                            w: 24.6,
                            h: 21.3
                        }, a = 0, r = 0, s = 0; a < o; a++, s++) {
                        var c = new THREE.Object3D,
                            l = new THREE.Geometry;
                        l.vertices[0] = new THREE.Vector3(i.w / 2, i.h / 2, 0), l.vertices[1] = new THREE.Vector3(-i.w / 2, i.h / 2, 0), l.vertices[2] = new THREE.Vector3(0, -i.h / 2, 0), l.faces[0] = new THREE.Face3(0, 1, 2);
                        var d = new THREE.MeshBasicMaterial({
                                color: 16777215,
                                transparent: !0
                            }),
                            m = new THREE.Mesh(l, d);
                        m.position.set(0, 0, 0), m.name = "death", c.add(m);
                        var l = new THREE.PlaneGeometry(i.w, i.h, 1),
                            d = new THREE.MeshBasicMaterial({
                                map: u.works,
                                transparent: !0
                            }),
                            h = new THREE.Mesh(l, d),
                            f = 0;
                        r % 2 == 0 && (f = .5 * i.w), c.position.x = s * (.5 * i.w) + f, c.position.y = r * i.h, s > e && (s = 0, r++), c.add(h), s % 2 == 0 && (c.rotation.z = Math.PI / 180 * 180), g(c), p.works.add(c)
                    }
                    t.add(p.works), p.works.name = "works", p.works.position.x = -1 * i.w * .5 * e / 2, p.works.position.y = -1 * i.h * n / 2
                },
                hover: function() {
                    var e = r.intersectObjects(p.works.children, !0);
                    if (e.length < 10)
                        for (var t = 0; t < e.length; t++) "death" == e[t].object.name && this.action(e[t].object)
                },
                action: function(t) {
                    if (!t.isAnimation) {
                        t.isAnimation = !0;
                        new TimelineMax({
                            yoyo: !0,
                            repeat: 1,
                            repeatDelay: 0
                        }).to(t.material, .4, {
                            opacity: 0,
                            ease: Power1.easeOut,
                            onUpdate: function() {
                                e = !0
                            },
                            onComplete: function() {
                                setTimeout(function() {
                                    t.isAnimation = !1
                                }, 500)
                            }
                        }, 0)
                    }
                },
                leave: function() {
                    f(p.works.children, "works")
                }
            },
            contact: {
                init: function() {
                    this.create(), l = this.hover.bind(this), w = this.resize.bind(this)
                },
                resize: function() {
                    f(p.contact.children, "contact", this.create)
                },
                create: function() {
                    var e = Math.ceil(window.innerWidth / 128) + 2,
                        n = Math.ceil(window.innerHeight / 55) + 3;
                    "sp" == getDevice && (e *= 2, n *= 2);
                    for (var o = Math.floor(e * n), i = 1, a = {
                            w: 24.5 / i,
                            h: 21 / i
                        }, r = 0, s = 0, c = 0; r < o; r++, c++) {
                        var l = new THREE.Object3D,
                            d = new THREE.PlaneGeometry(a.w, a.h, 2, 1),
                            m = new THREE.MeshBasicMaterial({
                                color: 16777215
                            }),
                            h = new THREE.Mesh(d, m),
                            i = 6.8;
                        h.geometry.vertices[0].y -= i + .1, h.geometry.vertices[2].y -= i, h.geometry.vertices[4].y += i + .1, h.geometry.dymanic = !0, h.geometry.verticesNeedUpdate = !0, h.name = "contact", l.add(h);
                        var f = new THREE.PlaneBufferGeometry(a.w, a.h, 1),
                            w = new THREE.MeshBasicMaterial({
                                map: u.contact,
                                transparent: !0
                            }),
                            y = new THREE.Mesh(f, w),
                            v = 0;
                        s % 2 == 0 && (v = a.w / 2, l.rotation.z = 1 * Math.PI), l.add(y), l.position.x = c * a.w + v, l.position.y = s * (.66 * a.h), g(l), c > e && (c = 0, s++), p.contact.add(l)
                    }
                    t.add(p.contact), p.contact.position.x = -1 * a.w * e / 2 - a.w, p.contact.position.y = -1 * a.h * .64 * s / 2, this.vertices = p.contact.children[0].children[0].geometry.vertices
                },
                hover: function() {
                    var e = r.intersectObjects(p.contact.children, !0);
                    if (e.length < 10)
                        for (var t = 0; t < e.length; t++) "contact" == e[t].object.name && this.action(e[t].object)
                },
                action: function(t) {
                    function n() {
                        t.geometry.verticesNeedUpdate = !0, e = !0
                    }
                    if (!t.geometry.isAnimation) {
                        t.geometry.isAnimation = !0, t.geometry.dymanic = !0, t.geometry.verticesNeedUpdate = !0;
                        var o = [this.vertices[0].y, this.vertices[1].y, this.vertices[2].y, this.vertices[3].y, this.vertices[4].y, this.vertices[5].y],
                            i = [new TimelineMax, new TimelineMax, new TimelineMax, new TimelineMax, new TimelineMax, new TimelineMax];
                        i[0].to(t.geometry.vertices[0], 0, {
                            y: o[3],
                            delay: .25,
                            onUpdate: n
                        }).to(t.geometry.vertices[0], .25, {
                            y: o[0],
                            ease: Cubic.easeInOut,
                            onUpdate: n
                        }), i[1].to(t.geometry.vertices[1], 0, {
                            y: o[4],
                            delay: .25,
                            onUpdate: n
                        }).to(t.geometry.vertices[1], .25, {
                            y: o[1],
                            ease: Cubic.easeInOut,
                            onUpdate: n
                        }), i[2].to(t.geometry.vertices[2], 0, {
                            y: o[5],
                            delay: .25,
                            onUpdate: n
                        }).to(t.geometry.vertices[2], .25, {
                            y: o[2],
                            ease: Cubic.easeInOut,
                            onUpdate: n
                        }), i[3].to(t.geometry.vertices[3], .25, {
                            y: o[0],
                            ease: Cubic.easeInOut,
                            onUpdate: n
                        }).to(t.geometry.vertices[3], 0, {
                            y: o[3],
                            onUpdate: n
                        }), i[4].to(t.geometry.vertices[4], .25, {
                            y: o[1],
                            ease: Cubic.easeInOut,
                            onUpdate: n
                        }).to(t.geometry.vertices[4], 0, {
                            y: o[4],
                            onUpdate: n
                        }), i[5].to(t.geometry.vertices[5], .25, {
                            y: o[2],
                            ease: Cubic.easeInOut,
                            onUpdate: n
                        }).to(t.geometry.vertices[5], 0, {
                            y: o[5],
                            onUpdate: n
                        }), setTimeout(function() {
                            t.geometry.isAnimation = !1
                        }, 1e3)
                    }
                },
                leave: function() {
                    f(p.contact.children, "contact")
                }
            }
        }
    }(),
    component = {
        header: function() {
            function e() {
                n(), ++r < c && (i = requestAnimationFrame(e))
            }

            function t() {
                n(), --r >= 0 && (i = requestAnimationFrame(t))
            }

            function n() {
                var e = o(r);
                a.css({
                    "background-position": -1 * s.width * e.x + "px " + -1 * s.height * e.y + "px"
                })
            }

            function o(e) {
                return e < 0 && (e = 0), {
                    x: e % 4,
                    y: Math.floor(e / 4)
                }
            }
            var i, a = $(".junni-logo"),
                r = 0,
                s = {
                    width: a.width(),
                    height: a.height()
                },
                c = 25;
            a.on({
                mouseenter: function() {
                    cancelAnimationFrame(i), i = requestAnimationFrame(e)
                },
                mouseleave: function() {
                    cancelAnimationFrame(i), i = requestAnimationFrame(t)
                }
            }), $(".openMenu").on({
                click: function(e) {
                    e.preventDefault(), $("html").toggleClass("open"), "sp" == getDevice && ($("html").hasClass("open") ? $(window).on("touchmove.noScroll", function(e) {
                        e.preventDefault()
                    }) : $(window).off(".noScroll"))
                }
            }), $(".junni-logo").on({
                click: function() {
                    isIntro = !1
                }
            })
        },
        
        checkScrollView: function() {
            for (var e = $(window).scrollTop(), t = 0; t < $(".scroll").length; t++) e + .8 * window.innerHeight > $(".scroll").eq(t).offset().top ? $(".scroll").eq(t).addClass("view") : $(".scroll").eq(t).removeClass("view")
        },
        scrollView: function() {
            var e = this;
            $(window).on({
                scroll: function() {
                    e.checkScrollView()
                }
            })
        },
        releaseList: function() {
            $(".release-item h2").matchHeight({
                byRow: !1
            }), "sp" != getDevice && $(".release-item").on({
                mouseenter: function(e) {
                    e.preventDefault(), $(this).find(".release-circle").css({
                        top: e.offsetY,
                        left: e.offsetX
                    })
                },
                mouseleave: function(e) {
                    e.preventDefault(), $(this).find(".release-circle").css({
                        top: e.offsetY,
                        left: e.offsetX
                    })
                }
            })
        },
        smoothScroll: function() {
            smoothScroll.init({
                easing: "easeOutCubic"
            })
        }
    },
    page = {
        slug: "",
        init: function() {
            page.home.init(), page.about.init(), page.works.init(), page.release.init(), page.contact.init(), component.header(), component.smoothScroll(), bg.init(), page.show()
        },
        smoothScroll: function() {
            smoothScroll.init({
                easing: "easeOutCubic"
            })
        },
        show: function() {
            component.scrollView(), component.releaseList(), setTimeout(function() {
                component.checkScrollView()
            }, 500)
        },
        loading: function() {},
        home: Barba.BaseView.extend({
            namespace: "home",
            onEnter: function() {
                setPageBg(this.namespace), smoothScroll.animateScroll(0), $("html").addClass("view-home"), isIntro ? ($("html").removeClass("view-home"), $("html").addClass("scrolledIntro"), $("html").addClass("scrolledIntroAfter")) : intro.init()
            },
            onEnterCompleted: function() {
                component.globalNav("home")
            },
            onLeave: function() {
                isIntro || intro.leave(), $("html").removeClass("view-home"), $("html").removeClass("scrolledIntro"), $("html").removeClass("scrolledIntroAfter")
            },
            onLeaveCompleted: function() {}
        }),
        about: Barba.BaseView.extend({
            namespace: "about",
            onEnter: function() {
                setPageBg(this.namespace), $("html").addClass("view-about"), gmap.init()
            },
            onEnterCompleted: function() {
                component.globalNav("about")
            },
            onLeave: function() {
                $("html").removeClass("view-about")
            },
            onLeaveCompleted: function() {}
        }),
        release: Barba.BaseView.extend({
            namespace: "release",
            onEnter: function() {
                setPageBg(this.namespace)
            },
            onEnterCompleted: function() {
                component.globalNav("release")
            },
            onLeave: function() {},
            onLeaveCompleted: function() {}
        }),
        works: Barba.BaseView.extend({
            namespace: "works",
            onEnter: function() {
                setPageBg(this.namespace), this.flg || (this.flg = !0), worksCanvas.init()
            },
            flg: !1,
            onEnterCompleted: function() {
                component.globalNav("works")
            },
            onLeave: function() {
                worksCanvas.leave(), this.flg = !1
            },
            onLeaveCompleted: function() {}
        }),
        contact: Barba.BaseView.extend({
            namespace: "contact",
            onEnter: function() {
                setPageBg(this.namespace), this.setting()
            },
            settingFlg: !1,
            setting: function() {
                if (!this.settingFlg) {
                    this.settingFlg = !0;
                    var e = this;
                    $(".btn-confirm").on({
                        click: function(t) {
                            t.preventDefault(), e.validation()
                        }
                    }), $(".btn-back").on({
                        click: function(t) {
                            t.preventDefault(), e.backInput()
                        }
                    }), $(".btn-send").on({
                        click: function(t) {
                            t.preventDefault(), e.send()
                        }
                    }), $(".view-policy").on({
                        click: function(e) {
                            e.preventDefault(), $("body").addClass("viewPolicy"), $(".privacypolicy").scrollTop(0)
                        }
                    }), $(".btn-policyClose").on({
                        click: function(e) {
                            e.preventDefault(), $("body").removeClass("viewPolicy")
                        }
                    })
                }
            },
            validation: function() {
                for (var e = $(".require-item"), t = e.find("input"), n = 0, o = 0; o < t.length; o++) t.eq(o).val() ? e.eq(o).removeClass("error-item") : (e.eq(o).addClass("error-item"), n++);
                $("input:checked").val() ? $(".checkbox").removeClass("error") : ($(".checkbox").addClass("error"), n++), 0 == n && this.confirm(), smoothScroll.animateScroll(document.querySelector(".step-area"))
            },
            backInput: function() {
                $("#form").removeClass("confirm"), $("input,textarea").prop("disabled", !1), $(".step-area").removeClass("step2").addClass("step1"), smoothScroll.animateScroll(document.querySelector(".step-area"))
            },
            confirm: function() {
                $("#form").addClass("confirm"), $("input,textarea").prop("disabled", !0), $(".step-area").removeClass("step1").addClass("step2")
            },
            send: function() {
                smoothScroll.animateScroll(document.querySelector(".step-area")), this.thanks()
            },
            thanks: function() {
                $(".step-area").removeClass("step2").addClass("step3"), $("#contact").addClass("showThanks"), $.ajax({
                    type: "POST",
                    url: "/submit.php",
                    data: {
                        company: $("input[name=company]").val(),
                        name: $("input[name=name]").val(),
                        email: $("input[name=email]").val(),
                        tel: $("input[name=tel]").val(),
                        contact: $("textarea").val()
                    },
                    success: function(e) {}
                })
            },
            onEnterCompleted: function() {
                component.globalNav("contact")
            },
            onLeave: function() {
                this.settingFlg = !1, $(".btn-confirm").off({
                    click: function(e) {
                        e.preventDefault(), that.validation()
                    }
                }), $(".btn-back").off({
                    click: function(e) {
                        e.preventDefault(), that.backInput()
                    }
                }), $(".btn-send").off({
                    click: function(e) {
                        e.preventDefault(), that.send()
                    }
                }), $(".view-policy").off({
                    click: function(e) {
                        e.preventDefault(), $("body").addClass("viewPolicy"), $(".privacypolicy").scrollTop(0)
                    }
                }), $(".btn-policyClose").off({
                    click: function(e) {
                        e.preventDefault(), $("body").removeClass("viewPolicy")
                    }
                }), $("body").removeClass("viewPolicy")
            },
            onLeaveCompleted: function() {}
        })
    },
    worksCanvas = function() {
        function e() {
            if (r = $(".worksCanvas"), wrapTarget = $(".work-link"), "sp" != getDevice) {
                s || t();
                for (var e = 0; e < r.length; e++) r.eq(e).data("image") && n(e);
                a()
            } else
                for (var e = 0; e < r.length; e++) r.eq(e).data("image") && r.eq(e).css({
                    "background-image": "url(" + r.eq(e).data("image") + ")"
                })
        }

        function t() {
            var e = {};
            d3threeD(e), path = e.transformSVGPath("M3.7,6C3.4,6.3,2.4,6.7,1.5,6.6C0.4,6.5-0.4,5.4,0.3,4.1c0.7-1.4,2.4-2.2,2.3-3.2c0-0.2-0.1-0.5-0.9-0.8 c3.2,0.1,4.5,0.8,5.2,1.8c1,1.6,1.1,4.2-1.2,4.8C4,7.1,3.7,6,3.7,6z");
            var t = new THREE.ShapePath;
            t.subPaths = path.subPaths, t.currentPath = path.currentPath;
            var n = t.toShapes(!0),
                o = new THREE.ShapeGeometry(n[0]);
            o.center();
            var i = new THREE.MeshBasicMaterial({
                color: 16777215
            });
            s = new THREE.Mesh(o, i);
            for (var a = 0; a < s.geometry.vertices.length; a++) s.geometry.vertices[a].set(.11 * s.geometry.vertices[a].x, .11 * s.geometry.vertices[a].y, .11 * s.geometry.vertices[a].z)
        }

        function n(e) {
            var t = new THREE.Scene,
                n = new THREE.PerspectiveCamera(75, 2, .2, 1e3);
            n.position.z = 2.8;
            var a = new THREE.WebGLRenderer({
                antialias: !0,
                alpha: !0,
                canvas: r.eq(e)[0]
            });
            a.setPixelRatio(3), a.autoClear = !1;
            var s = !1;
            l.load(r.eq(e).data("image"), function(o) {
                var i = new THREE.PlaneGeometry(8.6, 4.3, 6, 11);
                i.center();
                var r = new THREE.MeshBasicMaterial({
                        color: 16777215,
                        map: o
                    }),
                    l = new THREE.Mesh(i, r);
                t.add(l), c[e] = {
                    scene: t,
                    camera: n,
                    renderer: a,
                    mesh: l,
                    geometry: {
                        faces: JSON.parse(JSON.stringify(l.geometry.faces)),
                        vertices: JSON.parse(JSON.stringify(l.geometry.vertices))
                    },
                    renderFlg: !0,
                    animation: null,
                    tween: {
                        v: new TimelineMax({}),
                        p: new TimelineMax({})
                    }
                }, s = !0
            }), wrapTarget.eq(e).on({
                mouseenter: function() {
                    s && o(e)
                },
                mouseleave: function() {
                    s && i(e)
                }
            })
        }

        function o(e) {
            for (var t = 0; t < c[e].mesh.geometry.vertices.length; t++) tm[t] = new TimelineMax({}), tm[t].to(c[e].mesh.geometry.vertices[t], u + .2 * Math.random(), {
                x: s.geometry.vertices[t].x,
                y: s.geometry.vertices[t].y,
                z: s.geometry.vertices[t].z,
                ease: Power1.easeInOut,
                onUpdate: function() {
                    c[e] && (c[e].mesh.geometry.verticesNeedUpdate = !0, c[e].renderFlg = !0)
                }
            });
            d = new TimelineMax({}), d.to(c[e].mesh.position, u, {
                x: 3.6,
                y: -1.4,
                z: 0
            }), m = new TimelineMax({}), m.to(c[e].mesh.scale, u + .35, {
                x: 0,
                y: 0,
                z: 0,
                onUpdate: function() {
                    c[e] && (c[e].renderFlg = !0)
                }
            })
        }

        function i(e) {
            for (var t = 0; t < c[e].mesh.geometry.vertices.length; t++) tm[t].pause(0).kill(), c[e].renderFlg = !0, c[e].mesh.geometry.verticesNeedUpdate = !0, c[e].mesh.geometry.x = c[e].geometry.vertices[t].x, c[e].mesh.geometry.y = c[e].geometry.vertices[t].y, c[e].mesh.geometry.z = c[e].geometry.vertices[t].z;
            d.pause(d.totalDuration()).kill().fromTo(c[e].mesh.position, u, {
                x: 0,
                y: -3,
                w: 0,
                onUpdate: function() {
                    c[e].renderFlg = !0
                }
            }, {
                x: 0,
                y: 0,
                z: 0,
                onUpdate: function() {
                    c[e].renderFlg = !0
                }
            }).play(), m.pause(0).kill()
        }

        function a() {
            animationFlg && requestAnimationFrame(a);
            for (var e = 0; e < r.length; e++) {
                var t = c[e];
                t && t.renderFlg && (t.renderer.render(t.scene, t.camera), t.renderFlg = !1)
            }
        }
        var r, s, c = [],
            l = new THREE.TextureLoader;
        l.crossOrigin = "*", tm = [];
        var d = new TimelineMax({}),
            m = new TimelineMax({}),
            u = .4;
        return {
            init: function() {
                animationFlg = !0, e()
            },
            leave: function() {
                animationFlg = !1;
                for (var e = 0; e < c.length; e++) c[e] && (c[e].scene.remove(c[e].mesh), c[e].mesh.geometry.dispose(), c[e].mesh.material.dispose(), c[e].renderer.dispose(c[e].mesh), c[e].renderer.dispose(c[e].mesh.geometry), c[e].renderer.dispose(c[e].mesh.material), c[e].scene.children.length = 0);
                c.length = 0
            }
        }
    }(),
    loading = function() {
        function e() {
            var e, t = o(0);
            m.strokeStyle = t, m.beginPath();
            for (var n = 0, i = c.length; n < i; n++) c[n + 1] ? (m.moveTo(c[n].x, c[n].y), m.lineTo(c[n + 1].x, c[n + 1].y)) : m.lineTo(c[n].x, c[n].y), (e = o(n)) && e != t && (m.closePath(), m.stroke(), m.beginPath(), m.strokeStyle = e, t = e);
            m.closePath(), m.stroke()
        }

        function t(e) {
            for (var t = document.getElementById(e), n = t.getTotalLength(), o = [], i = 0; i <= u; i++) o.push(t.getPointAtLength(n * i / u));
            return o
        }

        function n() {
            for (var e = [], t = 0; t <= u; t++) e.push({
                x: r[t].x + (s[t].x - r[t].x) * g.percentage,
                y: r[t].y + (s[t].y - r[t].y) * g.percentage
            });
            return e
        }

        function o(e) {
            var t = e / u + p;
            t > 1 && (t -= 1);
            var n = Math.floor(7 * t);
            return l[n]
        }

        function i() {
            f || (m.clearRect(0, 0, 200, 200), p += .009, c = n(), p >= 1 && (p = 0), e(), requestAnimationFrame(i))
        }

        function a() {
            r = w[h], s = h + 1 <= 5 ? w[h + 1] : w[0], TweenLite.to(g, .7, {
                percentage: 1,
                ease: Power2.easeInOut,
                delay: .3,
                onComplete: function() {
                    g.percentage = 0, h++, h > 5 && (h = 0), a()
                }
            })
        }
        var r, s, c, l = ["#b3fa0a", "#CCCCCC"],
            d = document.getElementById("canvas"),
            m = d.getContext("2d"),
            u = 200,
            p = 0,
            h = 0,
            g = {
                percentage: 0
            },
            f = !1;
        m.lineWidth = 16, m.lineCap = "round";
        var w = [t("arrow-path"), t("circle-path"), t("rect-path"), t("hexagon-path"), t("triangle-path"), t("tetra-path")];
        return {
            play: function() {
                a(), i()
            },
            stop: function() {
                f = !0
            }
        }
    }();
loading.play();

    intro_sp = function() {
        function e(e) {
            return e.touches[0].pageY
        }

        function t() {
            clearTimeout(n), n = setTimeout(function() {
                i++, i < 2 && $("#intro").attr("class", "sp-step" + i), 2 == i && (setTimeout(function() {
                    $("html").addClass("scrolledIntro"), smoothScroll.animateScroll(10)
                }, 200), setTimeout(function() {
                    $("html").addClass("scrolledIntroAfter")
                }, 200))
            }, 500)
        }
        var n, o = {},
            i = 0;
        return {
            init: function() {
                i = 0, $("body").addClass("sp"), $("#intro").on({
                    touchstart: function(t) {
                        t.preventDefault(), o.position = e(event), o.direction = ""
                    },
                    touchmove: function(n) {
                        o.position - e(event) > 70 && t()
                    }
                }), $(".ic-scroll").on({
                    touchstart: function() {
                        t()
                    }
                })
            },
            leave: function() {
                $("body").removeClass("sp")
            },
            resize: function() {}
        }
    },
    intro = function() {
        function e() {
            x = {}, i(), x.scene = new THREE.Scene, n(), a(), d(), l(), c(), x.jsonLoader = new THREE.JSONLoader, x.texLoader = new THREE.TextureLoader, x.texLoader.crossOrigin = "*", x.fontLoader = new THREE.FontLoader, x.jsonLoader.load(wp_path + "model/baku.json", function(e, t) {
                x.texLoader.load(wp_path + "model/baku.jpg", function(n) {
                    r(e, t, n)
                })
            }), x.fontLoader.load(wp_path + "font/FilsonSoft_Regular.json", function(e) {
                s(e)
            }), $("body").addClass("canScroll");
            var e, m = "onwheel" in document ? "wheel" : "onmousewheel" in document ? "mousewheel" : "DOMMouseScroll";
            $("#intro").on(m, function(t) {
                clearTimeout(e), e = setTimeout(function() {
                    g()
                }, 200)
            }), $("#intro").on({
                touchstart: function(e) {
                    e.preventDefault(), x.position = t(event), x.direction = ""
                },
                touchmove: function(e) {
                    x.position - t(event) > 70 && g()
                }
            }), $(".ic-scroll").on({
                click: function() {
                    g()
                },
                touchstart: function() {
                    g()
                }
            }), window.addEventListener("resize", h), x.isStepAnimation = !0, x.stepIndex = 0, x.stepWait = 800, x.isAnimation = !0, o()
        }

        function t(e) {
            return e.touches[0].pageY
        }

        function n() {
            x.renderer = new THREE.WebGLRenderer({
                alpha: !0,
                antialias: !0,
                canvas: document.getElementById("introCanvas")
            }), x.renderer.setSize(window.innerWidth, window.innerHeight), x.renderer.setPixelRatio(window.devicePixelRatio || 1), x.renderer.shadowMap.enabled = !0, x.renderer.shadowMapSoft = !0, x.renderer.shadowMap.type = THREE.PCFSoftShadowMap
        }

        function o() {
            if (x) {
                if (x.isAnimation && requestAnimationFrame(o), w && w.isDrop && (x.world.step(1 / 60), w.position.copy(x.bakuBody.position), w.quaternion.copy(x.bakuBody.quaternion)), y && (y.position.copy(x.conceptBody.position), y.quaternion.copy(x.conceptBody.quaternion)), x.textBody)
                    for (var e = 0; e < x.textBody.length; e++) x.textBody[e].isActive ? (v[e].position.copy(x.textBody[e].position), v[e].quaternion.copy(x.textBody[e].quaternion)) : x.textBody[e].position.copy(v[e].position);
                x.renderer && x.renderer.render(x.scene, x.camera)
            }
        }

        function i() {
            x.world = new CANNON.World, x.world.broadphase = new CANNON.NaiveBroadphase, x.world.gravity.set(0, -8.82, 0), x.world.solver.iterations = 10, x.world.solver.tolerance = .1, x.world.defaultContactMaterial.contactEquationStiffness = 5e6, x.world.defaultContactMaterial.contactEquationRelaxation = 3, x.textMaterial = new CANNON.Material, x.bakuMaterial = new CANNON.Material, x.baku2text = new CANNON.ContactMaterial(x.bakuMaterial, x.textMaterial, {
                friction: 0,
                restitution: 2
            }), x.world.addContactMaterial(x.baku2text)
        }

        function a() {
            x.camera = new THREE.PerspectiveCamera(55, window.innerWidth / window.innerHeight, .1, 50), x.camera.position.y = 4, x.camera.position.z = 10, "sp" == getDevice && (x.camera.position.z = 11.3)
        }

        function r(e, t, n) {
            e.center(), n.minFilter = THREE.LinearFilter, n.magFilter = THREE.LinearFilter, w = new THREE.Mesh(e, new THREE.MeshPhongMaterial({
                map: n,
                shininess: 25
            })), w.position.y = 11, w.rotation.y = Math.PI / 180 * 270;
            w.scale.set(.8, .8, .8), w.castShadow = !0, w.isDrop = !1, x.scene.add(w), x.bakuBody = new CANNON.Body({
                mass: 20,
                material: x.bakuMaterial
            }), x.bakuBody.name = "baku", x.bakuBody.isAnimation = !0, x.bakuBody.position.y = 11, x.bakuBody.linearDamping = .4, x.bakuBody.quaternion.setFromAxisAngle(new CANNON.Vec3(.3, 1, .3), -Math.PI / 2), x.bakuBody.angularVelocity.set(0, 0, 0), x.bakuBody.addShape(new CANNON.Box(new CANNON.Vec3(.4 * .8, .536, .8))), x.bakuBody.addEventListener("collide", function(e) {
                "textObj" == e.contact.bi.name && x.bakuBody.isAnimation && (u(), x.bakuBody.isAnimation = !1)
            }), x.world.add(x.bakuBody)
        }

        function s(e) {
            x.textObj = new THREE.Object3D, x.textBody = [], v = [];
            for (var t = 0; t < T.length; t++) x.TextGeometry = new THREE.TextGeometry(T[t].text, {
                size: .3,
                height: .02,
                curveSegments: 10,
                font: e,
                style: "normal"
            }), x.TextGeometry.center(), v[t] = new THREE.Mesh(x.TextGeometry, new THREE.MeshLambertMaterial({
                color: 1907997
            })), v[t].castShadow = !0, v[t].reciveShadow = !0, v[t].position.x = .26 * t - 1.5 + T[t].space.x, v[t].position.y = 4 + T[t].space.y, x.textObj.add(v[t]), x.textBody[t] = new CANNON.Body({
                mass: 1,
                material: x.textMaterial
            }), x.textBody[t].name = "textObj", x.textBody[t].group = T[t].group, x.textBody[t].position.y += 10, x.textBody[t].linearDamping = .4, x.textBody[t].angularVelocity.set(0, 0, 0), x.textBody[t].angularDamping = .1, x.textBody[t].addShape(new CANNON.Box(new CANNON.Vec3(.1, .15, .02))), x.world.add(x.textBody[t]);
            x.scene.add(x.textObj)
        }

        function c() {
            x.geometry = new THREE.BoxBufferGeometry(10.24 / 1.5, 5.12 / 1.5, 1), x.texLoader = new THREE.TextureLoader, x.texLoader.crossOrigin = "*", y = new THREE.Mesh(x.geometry, new THREE.MeshBasicMaterial({
                map: x.texLoader.load(wp_path + "images/concept.png"),
                transparent: !0
            })), x.scene.add(y), x.boxShape = new CANNON.Box(new CANNON.Vec3(3.2, 1.82, .8)), x.conceptBody = new CANNON.Body({
                mass: 0,
                material: new CANNON.Material
            }), x.conceptBody.position.y = -10, x.conceptBody.addShape(x.boxShape), x.conceptBody.isAnimation = !0, x.conceptBody.addEventListener("collide", function(e) {
                "textObj" == e.contact.bj.name && x.conceptBody.isAnimation && (x.conceptBody.isAnimation = !1, p()), "baku" == e.contact.bj.name && x.bakuBody.applyImpulse(new CANNON.Vec3(0, 0, 150), x.bakuBody.position)
            }), x.world.add(x.conceptBody)
        }

        function l() {
            x.baseSize = 15, x.geometry = new THREE.PlaneBufferGeometry(2 * x.baseSize, x.baseSize, 1), x.material = new THREE.ShadowMaterial,
                x.material.opacity = .2, b = new THREE.Mesh(x.geometry, x.material), x.texLoader = new THREE.TextureLoader, x.texLoader.crossOrigin = "*", x.material = new THREE.MeshLambertMaterial({
                    map: x.texLoader.load(wp_path + "images/bg_grad.jpg")
                }), E = new THREE.Mesh(x.geometry, x.material), b.receiveShadow = !0, b.rotation.x = E.rotation.x = Math.PI / 180 * 270, x.scene.add(b), x.scene.add(E), x.groundShape = new CANNON.Plane, x.groundBody = new CANNON.Body({
                    mass: 0,
                    material: new CANNON.Material
                }), x.groundBody.addShape(x.groundShape), x.groundBody.name = "ground", x.axisX = new THREE.Vector3(1, 0, 0), x.groundBody.quaternion.copy((new THREE.Quaternion).setFromAxisAngle(x.axisX, 270 * THREE.Math.DEG2RAD)), x.groundBody.angularDamping = 1, x.world.add(x.groundBody)
        }

        function d() {
            x.color = 7829367, x.light = new THREE.AmbientLight(x.color), x.scene.add(x.light), x.directionalLight = new THREE.DirectionalLight(16777215, 1), x.directionalLight.position.set(0, 10, 0).normalize(), x.directionalLight.castShadow = !0, x.directionalLight.lookAt(x.scene.position), x.shadowPoint = 10, x.directionalLight.shadow.camera.top = x.shadowPoint, x.directionalLight.shadow.camera.left = -x.shadowPoint, x.directionalLight.shadow.camera.right = x.shadowPoint, x.directionalLight.shadow.camera.bottom = -x.shadowPoint, x.directionalLight.shadow.camera.castShadow = !0, x.directionalLight.shadow.mapSize.width = 1024, x.directionalLight.shadow.mapSize.height = 1024, x.directionalLight.shadow.camera.near = 0, x.directionalLight.shadow.camera.far = 1e3, x.scene.add(x.directionalLight), x.spotLight = new THREE.SpotLight(16777215, .2), x.spotLight.position.set(0, 10, 0), x.spotLight.castShadow = !0, x.spotLight.angle = .3, x.spotLight.penumbra = .5, x.spotLight.decay = 2, x.spotLight.distance = 20, x.spotLight.shadow.mapSize.width = 1024, x.spotLight.shadow.mapSize.height = 1024, x.spotLight.shadow.camera.near = 8, x.spotLight.shadow.camera.far = 10, x.scene.add(x.spotLight)
        }

        function m() {
            x.ps = new TimelineMax({}), x.ps.to(x.conceptBody.position, 1, {
                x: 0,
                y: 4,
                z: 0,
                ease: Power1.easeInOut
            })
        }

        function u() {
            x.bakuBody.applyImpulse(new CANNON.Vec3(0, 230, 0), x.bakuBody.position), x.bakuBody.angularVelocity.set(Math.random(), Math.random(), Math.random());
            for (var e = 0; e < x.textBody.length; e++) 1 == x.textBody[e].group && (x.textBody[e].isActive = !0, x.textBody[e].angularVelocity.set(Math.random(), Math.random(), Math.random()), x.textBody[e].applyImpulse(new CANNON.Vec3(1, 0, 1.5), x.textBody[e].position), x.textBody[e].isAnimation = !0)
        }

        function p() {
            x.scale = 6, x.m = [-x.scale, x.scale];
            for (var e = 0; e < x.textBody.length; e++) 0 == x.textBody[e].group && (x.textBody[e].isActive = !0), x.z = x.m[Math.floor(Math.random() * x.m.length)], x.textBody[e].applyImpulse(new CANNON.Vec3(0, 0, x.z), x.textBody[e].position), x.textBody[e].angularVelocity.set(Math.random(), Math.random(), Math.random())
        }

        function h() {
            x.camera && (x.camera.aspect = window.innerWidth / window.innerHeight, x.camera.updateProjectionMatrix()), x.renderer.setSize(window.innerWidth, window.innerHeight)
        }

        function g() {
            x.isStepAnimation && (0 == x.stepIndex ? (w.isDrop = !0, x.isStepAnimation = !1, $("body").removeClass("canScroll"), setTimeout(function() {
                x.stepIndex++, x.isStepAnimation = !0, $("body").addClass("canScroll")
            }, x.stepWait)) : 1 == x.stepIndex ? (m(), x.isStepAnimation = !1, $("body").removeClass("canScroll"), setTimeout(function() {
                x.stepIndex++, x.isStepAnimation = !0, $("body").addClass("canScroll")
            }, x.stepWait)) : 2 == x.stepIndex && (x.stepIndex++, $("body").removeClass("canScroll"), x.isStepAnimation = !1, setTimeout(function() {
                x.isStepAnimation = !0, x.isAnimation = !1, $("html").addClass("scrolledIntro"), smoothScroll.animateScroll(10)
            }, 1500), x.tm = setTimeout(function() {
                $("html").addClass("scrolledIntroAfter"), f()
            }, 1500 + x.stepWait)))
        }

        function f() {
            if (x) {
                clearTimeout(x.tm), x.world.removeBody(x.bakuBody), x.world.removeBody(x.conceptBody), x.world.removeBody(x.groundBody), x.world.removeBody(x.boxShape), x.scene.remove(w), w.geometry.dispose(), w.material.dispose(), x.scene.remove(x.TextGeometry);
                for (var e = 0; e < v.length; e++) x.scene.remove(v[e]), v[e].geometry.dispose(), v[e].material.dispose(), x.world.removeBody(x.textBody[e]), v[e] = null;
                x.textObj.children.length = 0, x.scene.remove(y), y.geometry.dispose(), y.material.dispose(), x.scene.remove(b), b.geometry.dispose(), b.material.dispose(), x.scene.remove(E), E.geometry.dispose(), E.material.dispose(), x.scene.remove(x.directionalLight), x.scene.remove(x.spotLight), x.scene.remove(x.light), x.TextGeometry = null, x.world = null, x.scene.children.length = 0, x.renderer.dispose(), x = null, w = null, y = null, v.length = 0, window.removeEventListener("resize", h)
            }
        }
        if ("sp" == getDevice) return intro_sp();
        var w, y, v, b, E, x = {},
            T = [{
                text: "J",
                group: 0,
                space: {
                    x: 0,
                    y: .04
                }
            }, {
                text: "u",
                group: 0,
                space: {
                    x: 0,
                    y: 0
                }
            }, {
                text: "n",
                group: 0,
                space: {
                    x: 0,
                    y: 0
                }
            }, {
                text: "i",
                group: 1,
                space: {
                    x: -.06,
                    y: .04
                }
            }, {
                text: "o",
                group: 1,
                space: {
                    x: -.12,
                    y: 0
                }
            }, {
                text: "r",
                group: 1,
                space: {
                    x: -.15,
                    y: 0
                }
            }, {
                text: ".",
                group: 1,
                space: {
                    x: -.1,
                    y: 0
                }
            }, {
                text: "U",
                group: 1,
                space: {
                    x: 0,
                    y: .04
                }
            }, {
                text: "n",
                group: 0,
                space: {
                    x: .01,
                    y: 0
                }
            }, {
                text: "i",
                group: 0,
                space: {
                    x: -.06,
                    y: .04
                }
            }, {
                text: "q",
                group: 1,
                space: {
                    x: -.13,
                    y: -.04
                }
            }, {
                text: "u",
                group: 1,
                space: {
                    x: -.13,
                    y: 0
                }
            }, {
                text: "e",
                group: 1,
                space: {
                    x: -.13,
                    y: 0
                }
            }];
        return {
            init: function() {
                e()
            },
            leave: function() {
                f()
            },
            resize: function() {
                h()
            }
        }
    }();
