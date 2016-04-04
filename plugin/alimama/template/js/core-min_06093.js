tbImgServerId = Math.floor(5 * Math.random() + 1);
$(document).ready(function() {
	initCommonFunc();
	initMainSearch();
	if ("undefined" != typeof g) for (var a in g.__gm__) eval(g.__gm__[a]);
	lazyLoadImg();
	initURL();
	initTabSwitch();
	setTimeout("lazyLoadImg()", 6E3);
	C(".lazy-img img", !0).run("lazyimg", {
		Furl: function(a) {
			return a = $.mz.decodeTbUrl(a)
		}
	});
	if (0 !== $(".footMenu").size() && (U_wrapper_footmenu = C(".footMenu", !0).run("wrapper"), U_wrapper_footmenu.windowWrap(), !$.browser.msie || !("6.0" == $.browser.version || "7.0" == $.browser.version))) $(".fM-backtop").fadeOut(0),
	$(window).scroll(function() {
		wrapper_footMenu()
	}),
	$(window).resize(function() {
		wrapper_footMenu()
	})
});
function wrapper_footMenu() {
	150 < $(window).scrollTop() && 0 == $(".fM-backtop:visible").size() && $(".fM-backtop").fadeIn(200);
	150 > $(window).scrollTop() && 1 == $(".fM-backtop:visible").size() && $(".fM-backtop").hide()
}
function initTabSwitch() {
	function a(a, c) {
		if (!a.hasClass("current")) {
			var d = a.parent().parent().parent();
			$(".tab-hd li.current", d).removeClass("current");
			a.addClass("current");
			$(".tab-panel", d).hide();
			d = $(".tab-panel:eq(" + c + ")", d);
			$("img", d).each(function() {
				var a = $(this).attr("data-src");
				void 0 != a && "" != a && (a = a.replace("t_p_i_c", "taobaocdn"), $(this).attr("src", a).attr("data-src", ""))
			});
			d.fadeIn()
		}
	}
	$(".tab-hd").each(function(b) {
		$("li", $(this)).each(function(c) { ! $(this).hasClass("more") && !$(this).hasClass("no-tab") && $(this).hoverDelay({
				hoverEvent: function() {
					a($(this), c)
				}
			})
		})
	});
	$(".toggle-door").click(function() {
		var a = $(this).attr("data-id");
		$("#" + a).slideToggle();
		$(this).hasClass("open") ? $(this).removeClass("open") : $(this).addClass("open")
	})
}
function lazyLoadImg() {
	$(".lazy-img-loader").each(function() {
		var a = $(this),
		b = $("img", a),
		c = b.attr("data-src");
		void 0 !== c && "" !== c && (c = $.mz.decodeTbUrl(c));
		null == c || 0 != c.indexOf("http://") ? b.hide().css("width", "50px").attr("src", "http://s0.mizhe.cn/image/icons/no-pic.png") : b.hide().attr("src", c);
		b.load(function() {
			this.complete && (a.removeClass("lazy-img-loader"), b.fadeIn().attr("data-src", ""))
		})
	})
}
function initURL() {
	if ("undefined" != typeof g) {
		var a = $.base64Decode(g.__go__);
		$(".redirect-tbk").each(function() {
			var b = $(this).attr("data-config");
			if (void 0 === b || "" === b) if (b = $(".redirect-tbk-global").attr("data-config"), void 0 === b || "" === b) return;
			var b = $.mz.parseJSON(b),
			c = " " + a + "rebate/taobao/" + b.type + "-" + b.nick + "-" + b.id + ".html?p=" + b.p + "&target=" + b.target + "&r=" + b.r + "&stop=" + (void 0 != b.stop ? b.stop: "");
			$(this).attr("rel", "nofollow").attr("target", "_blank").attr("href", c).removeClass("redirect-tbk").mousedown(function() {
				var a = "trace=tbkclick&t=" + b.type + "&i=" + b.id + "&nick=" + b.nick + "&p=" + b.p + "&r=" + b.r + "&g=" + b.target; (new Image).src = "http://stat.mizhe.com/tracelog/click.html?" + a + "&_t=" + (new Date).getTime()
			}).removeClass("redirect-tbk")
		});
		$(".outer-url").each(function() {
			var a = $(this).attr("data-url");
			void 0 === a || "" === a || (a = $.base64Decode(a), null == a || 0 != a.indexOf("http://") && 0 != a.indexOf("https://") || $(this).attr("rel", "nofollow").attr("href", a).removeClass("outer-url"))
		});
		$(".mz-click").mousedown(function() {
			var a = $(this).attr("data-params");
			if (! (void 0 == a || "" === a)) {
				var c = $.cookie("st_au");
				c || (c = 0);
				a = "au=" + c + "&log=" + $(this).attr("data-log") + "&" + a; (new Image).src = "http://click.mizhe.cn/tracelog/click.html?" + a + "&_t=" + (new Date).getTime()
			}
		})
	}
}
function initCommonFunc() {
	"function" !== typeof String.prototype.trim && (String.prototype.trim = function() {
		return this.replace(/^\s+|\s+$/g, "")
	});
	"function" !== typeof String.prototype.startsWith && (String.prototype.startsWith = function(a) {
		return this.match("^" + a) == a
	});
	$.cookie.defaults = {
		path: "/",
		domain: g.__cookieDomain__
	};
	$("input[type='text'], input[type='password']").focus(function() {
		$(this).addClass("i-focus")
	});
	$("input[type='text'], input[type='password']").blur(function() {
		$(this).removeClass("i-focus")
	});
	$(".logout-back").click(function(a) {
		a.preventDefault();
		a = $(this).attr("href");
		a = -1 === a.indexOf("?") ? a + "?done=": a + "&done=";
		a += encodeURIComponent(window.location);
		window.location = a
	});
	$("a").attr("hideFocus", "true");
	$(".quick-menu .drop-item").hover(function() {
		$(".drop-body", $(this)).show()
	},
	function() {
		$(".drop-body", $(this)).hide()
	});
	initSiteTopbar();
	initDataTips();
	$.cookie("bdpop") && ($.removeCookie("bdpop"), setTimeout("$.mz.bdPopup()", 1E3))
}
function initSiteTopbar() {
	var a = $(".site-top-nav .login-info");
	if (0 == a.attr("data-status") && $.mz.isLogin()) {
		var b = '\u60a8\u597d\uff0c<a rel="nofollow" href="http://i.mizhe.com/" hidefocus="true">' + $.mz.lastLoginId() + "</a>",
		c = $.cookie("_grade_");
		if (null != c) {
			var c = parseInt(c),
			d = "";
			switch (c) {
			case 1:
				d = "VIP\u94dc\u724c\u4f1a\u5458";
				break;
			case 2:
				d = "VIP\u94f6\u724c\u4f1a\u5458";
				break;
			case 3:
				d = "VIP\u91d1\u724c\u4f1a\u5458";
				break;
			case 4:
				d = "VIP\u767d\u91d1\u4f1a\u5458";
				break;
			case 5:
				d = "VIP\u94bb\u77f3\u4f1a\u5458";
				break;
			default:
				d = "\u666e\u901a\u4f1a\u5458"
			}
			b = b + '&nbsp;<a title="' + d + '" target="_blank" class="grade-min vip' + c + '" href="http://www.mizhe.com/dhtml/vip.html?f=top" hidefocus="true">' + d + "</a>"
		}
		$(".mline", a).html(b + '&nbsp;&nbsp;<a href="http://www.mizhe.com/member/logout.html">\u9000\u51fa</a>');
		$(".reg-tips", a).remove();
		$(".site-top-nav .quick-menu div.hidden").show()
	}
}
function initDataTips() {
	$(".data-tip").each(function() {
		0 == $(this).val().trim().length && $(this).val($(this).attr("data-tips")).addClass("c-ccc")
	}).focus(function() { ($(this).val().trim() == $(this).attr("data-tips") || $(this).hasClass("c-ccc")) && $(this).val("").removeClass("c-ccc")
	}).blur(function() { (0 == $(this).val().trim().length || $(this).val().trim() == $(this).attr("data-tips")) && $(this).val($(this).attr("data-tips")).addClass("c-ccc")
	})
}
function initNotice() {
	$(".quick-menu .m-ajax").each(function() {
		var a = $("em", $(this)),
		b = $(this).attr("data-url");
		$.getJSON(b + "?callback=?",
		function(c) {
			c.result && ("0" != c.data ? (a.html(c.data).css("display", "inline-block"), a.parent().parent().css("padding-right", "18px"), setTimeout("initNotice()", 1E4)) : (a.hide(), a.parent().parent().css("padding-right", "12px")))
		})
	})
}
function initMainSearch() {
	$(".main-search .tab-panel").each(function(a) {
		var b = $(this);
		a = $(".search-fields", b);
		var c = $("input", a),
		d = $("span", a).text();
		a = $(".search-submit", b);
		"" === c.val() && c.val(d).addClass("hint");
		c.focus(function() {
			qVal = c.val().trim(); ("" === qVal || qVal === d) && c.val("").removeClass("hint")
		});
		c.click(function() {
			qVal = c.val().trim();
			0 <= qVal.indexOf("http://") && c.select()
		});
		c.blur(function() {
			qVal = c.val().trim(); ("" === qVal || qVal === d) && c.val(d).addClass("hint")
		});
		a.click(function(a) {
			qVal = c.val().trim();
			if ("" === qVal || qVal === d) alert(d),
			a.preventDefault();
			else if (a.preventDefault(), a = $("form", b).attr("action"), a = a + "?q=" + encodeURIComponent(qVal), "_blank" == $("form", b).attr("target")) {
				var e = document.createElement("a");
				e.target = "_blank";
				e.href = a;
				document.body.appendChild(e);
				e.click()
			} else window.location = a
		})
	});
	$(".main-search .search-tabs li").each(function(a) {
		$(this).click(function() {
			var b = $(this);
			b.hasClass("current") || ($(".main-search .tab-panel").hide(), $(".main-search .search-tabs li.current").removeClass("current"), $(".main-search .tab-panel:eq(" + a + ")").show(), b.addClass("current"))
		})
	});
	$(".main-search .search-tabs li a").click(function(a) {
		a.preventDefault();
		$(this).blur()
	});
	$(".url-how-to span").hover(function() {
		$(".hover-tips", $(this).parent()).fadeIn(100)
	},
	function() {
		$(".hover-tips", $(this).parent()).fadeOut(100)
	})
}
function login(a, b) {
	var c = {
		_csrf_token: g.__t__,
		email: a,
		passwd: b
	};
	$.ajax({
		url: $.base64Decode(g.__b__) + "member/popup_login.html",
		type: "POST",
		cache: !1,
		data: c,
		dataType: "jsonp",
		jsonp: "callback",
		async: !1,
		success: function(a) {
			a.success ? ($("#popup-login-box").remove(), $("#overlay").remove(), window.location.reload()) : (alert(a.message), window.location = $.base64Decode(g.__b__) + "member/login.html")
		},
		error: function(a, c, b) { ! 0 == isIE6 ? window.location.reload() : alert("\u7f51\u7edc\u7e41\u5fd9")
		}
	})
}
function initLoginForm() {
	$("#do-comment").remove();
	$("#overlay").remove();
	$("#popup-login-box").remove();
	$("#popup-login-box input[name='passwd']").live("keydown",
	function(a) {
		"13" == a.keyCode && $("#popup-login-box .submit .button").trigger("click")
	});
	$.ajax({
		url: $.base64Decode(g.__b__) + "member/popup_login_form.html",
		type: "post",
		cache: !1,
		dataType: "jsonp",
		jsonp: "callback",
		async: !1,
		success: function(a) {
			$("body").prepend("<div id='overlay' class='overlay'></div>").prepend(a.html)
		},
		error: function(a, b, c) {}
	})
} (function(a) {
	var b = function() {
		var a = {
			ie: 0,
			opera: 0,
			gecko: 0,
			webkit: 0
		},
		d = navigator.userAgent,
		b;
		/KHTML/.test(d) && (a.webkit = 1);
		if ((b = d.match(/AppleWebKit\/([^\s]*)/)) && b[1]) a.webkit = parseFloat(b[1]);
		if (!a.webkit) if ((b = d.match(/Opera[\s\/]([^\s]*)/)) && b[1]) a.opera = parseFloat(b[1]);
		else if ((b = d.match(/MSIE\s([^;]*)/)) && b[1]) a.ie = parseFloat(b[1]);
		else if (b = d.match(/Gecko\/([^\s]*)/)) if (a.gecko = 1, (b = d.match(/rv:([^\s\)]*)/)) && b[1]) a.gecko = parseFloat(b[1]);
		return a
	} ();
	a.extend({
		mz: {}
	});
	a.extend(a.mz, {
		isLogin: function() {
			return null != a.cookie("st_au") ? !0 : !1
		},
		lastLoginId: function() {
			return a.cookie("_last_login_id_")
		},
		bdPopup: function() {
			a.mz.isLogin() || "undefined" != typeof g.__cancelBdPopup__ || (0 < a("#overlay").length && a("#overlay").is(":visible") ? setTimeout("$.mz.bdPopup()", 1500) : 0 < a("#landing-popup-bd").length || a.getJSON(a.base64Decode(g.__b__) + "member/bd_landing.html?done=" + encodeURIComponent(window.location) + "&callback=?",
			function(c) {
				c.result && !(0 < a("#landing-popup-bd").length) && (a("#content").prepend(c.html), a(".landing-popup-bd").each(function() {
					a.colorbox({
						innerWidth: 652,
						innerHeight: 362,
						initialWidth: 600,
						initialHeight: 300,
						close: "",
						inline: !0,
						scrolling: !1,
						overlayClose: !1,
						opacity: 0.8,
						title: a(".login-form").html(),
						fixed: !0,
						href: "#landing-popup-bd"
					});
					a(".reg-form input").focus(function() {
						var c = a(this).siblings("label");
						a(this).siblings(".indicator-field").removeClass("indicator-error").text("");
						a("span:not(.hint)", c).fadeOut(300,
						function() {
							a(".hint", c).fadeIn()
						})
					}).blur(function() {
						var c = a(this).siblings("label");
						a(".hint", c).hide();
						a("span:not(.hint)", c).show()
					});
					a(".reg-form .indicator-field").click(function() {
						a(this).removeClass("indicator-error").text("");
						a(this).siblings("input").focus()
					});
					a(".reg-form .submit-link").click(function() {
						var c = a(this),
						b = a(".i-email"),
						e = a(".i-passwd");
						b.siblings(".indicator-field").removeClass("indicator-error").text("");
						e.siblings(".indicator-field").removeClass("indicator-error").text("");
						var h = /\w+([-+.']\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*/,
						k = !1;
						if ("" === b || !h.test(b.val())) b.siblings(".indicator-field").addClass("indicator-error").text("\u65e0\u6548\u7684\u90ae\u7bb1\u5730\u5740"),
						b.val(""),
						k = !0;
						///^[a-zA-Z0-9`~@!#$%^&*()-=_+]{6,16}$/.exec(e.val()) || (e.siblings(".indicator-field").addClass("indicator-error").text("\u5bc6\u7801\u4e0d\u7b26\u5408\u89c4\u5219\uff0c\u8bf7\u91cd\u65b0\u8f93\u5165"), e.val(""), k = !0);
						k || (a(".i-repasswd").val(e.val()), c.hide(), c.siblings(".indicator-field").addClass("ajax-loader").text("\u3000\u6b63\u5728\u6ce8\u518c...").css("display", "inline-block"), a.ajax({
							type: "POST",
							url: b.attr("data-url") + "?t=" + (new Date).getTime(),
							data: {
								email: b.val(),
								_csrf_token: g.__t__
							},
							success: function(e) {
								e.result ? a(".reg-form form").submit() : (b.siblings(".indicator-field").addClass("indicator-error").text(e.message), c.siblings(".indicator-field").hide(), c.show())
							}
						}))
					})
				}))
			}))
		},
		encodeTbUrl: function(c) {
			url = c.replace("http://", "");
			url = url.replace("s.click.taobao.com/", "tbkurl/");
			url = url.replace("taobao.com/", "tbsite/");
			url = url.replace("/^img([0-9]*?).taobaocdn.com//is", "tbpic${1}/");
			url = a.base64Encode(url);
			url = url.replace("+", "-");
			return url = url.replace("/", "_")
		},
		decodeTbUrl: function(c) {
			url = c.replace("_", "/");
			url = url.replace("-", "+");
			decodeUrl = a.base64Decode(url);
			"" === decodeUrl && (url += "=", decodeUrl = a.base64Decode(url));
			"" === decodeUrl && (url += "=", decodeUrl = a.base64Decode(url));
			decodeUrl = decodeUrl.replace(/^tbpic([0-9]*)/i, "img$1.taobaocdn.com");
			decodeUrl = decodeUrl.replace("tbsite/", "taobao.com/");
			decodeUrl = decodeUrl.replace("tbkurl/", "s.click.taobao.com/");
			0 > decodeUrl.indexOf("http://") && (decodeUrl = "http://" + decodeUrl);
			return decodeUrl
		},
		deRound: function(a) {
			return 1 * (a + 1E-6).toString().replace(/(\.\d\d)\d+/ig, "$1")
		},
		type: function(a) {
			var b = Object.prototype.toString,
			f = {
				undefined: "undefined",
				number: "number",
				"boolean": "boolean",
				string: "string",
				"[object Function]": "function",
				"[object RegExp]": "regexp",
				"[object Array]": "array",
				"[object Date]": "date",
				"[object Error]": "error"
			};
			return f[typeof a] || f[b.call(a)] || (a ? "object": "null")
		},
		toJSON: function(c) {
			var b = [],
			f = {
				"\b": "\\b",
				"\t": "\\t",
				"\n": "\\n",
				"\f": "\\f",
				"\r": "\\r",
				'"': '\\"',
				"\\": "\\\\"
			},
			e = function(a) {
				return f[a] || "\\u00" + Math.floor(a.charCodeAt() / 16).toString(16) + (a.charCodeAt() % 16).toString(16)
			};
			switch (a.mz.type(c)) {
			case "undefined":
				return "undefined";
			case "null":
				return "null";
			case "number":
			case "boolean":
			case "date":
			case "function":
				return c.toString();
			case "string":
				return '"' + c.replace(/[\x00-\x1f\\"]/g, e) + '"';
			case "array":
				for (var e = 0,
				h = c.length; e < h; e++) b.push(a.mz.toJSON(c[e]));
				return "[" + b.join(",") + "]";
			case "error":
			case "object":
				for (h in c) b.push('"' + h + '":' + a.mz.toJSON(c[h]));
				return "{" + b.join(",") + "}";
			default:
				return ""
			}
		},
		parseJSON: function(a) {
			var d = null;
			"undefined" !== typeof JSON && (d = JSON);
			return null !== d ? d.parse(a) : b.gecko ? (new Function("return " + a))() : eval("(" + a + ")")
		},
		redirect: function(a) {
			if (document.all) {
				var b = document.createElement("a");
				b.href = a;
				self != top && (b.target = "_parent");
				document.body.appendChild(b);
				b.click()
			} else self != top ? parent.location.href = a: window.location = a
		},
		goodsSitesSupport: function(a) {
			var b = /tmall.com/i,
			f = /auction\d?.paipai.com/i,
			e = /buy.caomeipai.com\/goods/i,
			h = /www.360buy.com\/product/i,
			k = /product.dangdang.com\/Product.aspx\?product_id=/i,
			m = /book.360buy.com/i,
			n = /www.vancl.com\/StyleDetail/i,
			l = /www.vancl.com\/Product/i,
			q = /vt.vancl.com\/item/i,
			r = /item.vancl.com\/\d+/i,
			p = /item.vt.vancl.com\/\d+/i,
			s = /mbaobao.com\/pshow/i,
			t = /item.buy.qq.com\/item/i,
			u = /[www|us].topshop.com\/webapp\/wcs\/stores\/servlet\/ProductDisplay/i,
			v = /quwan.com\/goods/i,
			w = /nala.com.cn\/product/i,
			x = /maymay.cn\/pitem/i,
			y = /asos.com/i,
			z = /www.100f1.com\/ProductInfo_/i,
			A = /www.gaojie.com\/product/i,
			B = /a.m.taobao.com\/i/i,
			D = /www.51yugou.com\//i;
			return /item(.[\w]+)?.taobao.com\/(.?)[item.htm|item_num_id|item_detail|itemID|item_id|default_item_id]/i.test(a) || b.test(a) || m.test(a) || h.test(a) || f.test(a) || e.test(a) || k.test(a) || n.test(a) || l.test(a) || q.test(a) || r.test(a) || p.test(a) || s.test(a) || u.test(a) || v.test(a) || w.test(a) || x.test(a) || y.test(a) || z.test(a) || A.test(a) || t.test(a) || B.test(a) || D.test(a)
		},
		byteLength: function(a) {
			var b = a.match(/[^\x00-\x80]/g);
			return a.length + (!b ? 0 : b.length)
		},
		getMsgLength: function(b) {
			return 0 < b.length ? Math.ceil(a.mz.byteLength(b) / 2) : 0
		},
		wordCount: function(b, d, f) {
			var e = f ? f: 140;
			a("#" + b)[0] && (f = function() {
				var f = 0,
				f = d ? a.mz.getMsgLength(a("#" + d).val()) : a.mz.getMsgLength(a("#" + b).find(".pub_txt").val()),
				k = e - f;
				0 == f ? a("#" + b).find(".word-count em").html(e) : (a("#" + b).find(".word-count em").html(k), f > e ? a("#" + b).find(".word-count em").addClass("out") : a("#" + b).find(".word-count em").removeClass("out"))
			},
			d ? a("#" + d).bind("keyup", f).bind("input", f).bind("propertychange", f) : a("#" + b).find(".pub_txt").bind("keyup", f).bind("input", f).bind("propertychange", f))
		}
	})
})(jQuery); (function(a) {
	a.C = {};
	a.extend(a.C, {
		_method: {
			setConfig: function(a, c) {
				if ("string" === typeof a) return this.s[a] = c,
				[a, c];
				for (var d in a) this.s[d] = a[d];
				return this.s
			},
			getConfig: function(a) {
				return "string" === typeof a ? this.s[a] : this.s
			},
			rerun: function(b) {
				a.extend(this.s, b);
				this.m.init();
				return this.s
			}
		}
	});
	window.C = C = function(a, c) {
		return new C.fn.init(a, c)
	};
	C.fn = C.prototype = {
		init: function(b, c) {
			this.selector = b;
			"string" === typeof b && !c && (this.val = this.selector, this.typeis = "string");
			"object" === typeof b && (this.val = this.selector, this.typeis = "data");
			"[object Array]" === Object.prototype.toString.apply(b) && (this.val = this.selector, this.typeis = "array"); ! 0 === b instanceof Date && (this.val = this.selector, this.typeis = "date");
			return c ? a(b) : this
		},
		extend: function(a) {
			for (var c in a) C.fn[c] = a[c]
		},
		include: function(a) {
			for (var c in a) C[c] = a[c]
		}
	};
	C.fn.init.prototype = C.fn;
	C.fn.include({
		loadedList: "",
		rely: "",
		getinfo: function(a) {
			for (var c in C.registry) for (var d in C.registry[c]) if (d == a) return [c, d, C.registry[c][d]]
		}
	});
	a.fn.extend({
		run: function(b, c) {
			return new(a.C[C.getinfo(b)[0]][b])(a(this), c)
		}
	});
	C.fn.include({
		registry: {
			utility: {
				lazyimg: "js",
				wrapper: "js,css"
			},
			ext: {
				string: "js"
			}
		}
	})
})(jQuery);
$.C.utility = {};
$.extend($.C.utility, {
	_method: $.C._method
}); (function(a) {
	a.extend(a.C.utility, {
		lazyimg: function(b, c) {
			a.C.utility.lazyimg.defaults = {
				Container: b ? b: a(".obj-U-lazyimg"),
				DefImg: "http://s0.mizhe.cn/image/blank.png",
				Attr: "data-src",
				Advance: 450,
				Furl: function(a) {}
			};
			var d = this.s = a.extend({},
			a.C.utility.lazyimg.defaults, c || {}),
			f = this.c = d.Container,
			e,
			h,
			k,
			m,
			n,
			l = this.m = {
				init: function() {
					f.attr("src", d.DefImg);
					l.getViewImg();
					a(window).scroll(function() {
						a(".lazy-img").size() && l.getViewImg()
					});
					a(window).resize(function() {
						a(".lazy-img").size() && l.getViewImg()
					})
				},
				getViewImg: function() {
					var b = [];
					m = a(window).scrollTop();
					k = m + a(window).height();
					a(window).scrollLeft();
					a(window).width();
					n = f.not(".ST-uLi-loaded");
					for (var c = n.size(), p = 0; p < c; p++) h = n.eq(p),
					h.offset(),
					e = h.offset().top,
					e < k + d.Advance && e + h.height() > m - d.Advance && b.push(h);
					b && l.loadImg(b)
				},
				loadImg: function(a) {
					for (var b in a) {
						_o = a[b];
						_o.hide();
						src = d.Furl(_o.attr(d.Attr)) || _o.attr(d.Attr);
						if (null == src || 0 != src.indexOf("http://")) src = "http://s0.mizhe.cn/image/icons/no-pic.png";
						_o.attr("src", src).addClass("ST-uLi-loaded").fadeIn(500);
						_o.closest(".lazy-img").removeClass("lazy-img")
					}
				}
			};
			l.init()
		}
	});
	a.C.utility.lazyimg.prototype = a.C.utility._method
})(jQuery);
C.fn.extend({
	toNum: function() {
		if (!this.isString()) return this;
		this.val = parseFloat(this.val);
		this.val = isNaN(this.val) ? 0 : this.val;
		return this
	},
	isString: function() {
		return "string" !== this.typeis ? !1 : !0
	}
}); (function(a) {
	a.extend(a.C.utility, {
		wrapper: function(b, c) {
			a.C.utility.wrapper.defaults = {
				Container: b ? b: a(".obj-U-wraper")
			};
			var d = this.c = (this.s = a.extend({},
			a.C.utility.wrapper.defaults, c || {})).Container,
			f,
			e,
			h,
			k = this.m = {
				init: function() {
					return this
				},
				wrapWindow: function() {
					cT = d.offset().top;
					cL = d.offset().left;
					d.wrap('<div class="cc-uWrp-window"></div>');
					d.w = d.closest(".cc-uWrp-window");
					d.w.f = d.w.closest(a("*").not(d.w));
					k.wrapWindow_Setbox(!1);
					a(window).resize(function() {
						k.wrapWindow_Setbox(!1)
					});
					a(window).scroll(function() {
						h != a(window).width() && k.wrapWindow_Setbox(!1)
					});
					return d.w
				},
				wrapWindow_Setbox: function(b) {
					f = d.w.f.offset().top - d.w.f.scrollTop();
					e = d.w.f.offset().left - d.w.f.scrollLeft();
					d.w.css({
						width: h = a(window).width(),
						height: a(window).height()
					});
					b && d.w.css({
						"margin-top": -f,
						"margin-left": -e
					})
				}
			};
			k.init();
			this.windowWrap = function() {
				return k.wrapWindow()
			};
			this.meWrap = function() {
				return k.wrapMe()
			}
		}
	});
	a.C.utility.wrapper.prototype = a.C.utility._method
})(jQuery);