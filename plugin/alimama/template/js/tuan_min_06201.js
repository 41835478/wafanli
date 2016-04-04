$(document).ready(function() {
	0 < $(".infinite-scroll").length && (0 < $(".infinite-scroll li.stop").length ? 0 < $(".pagination").length && $(".pagination").show() : bindScroll($(".infinite-scroll")))
});
function show_date_time(d, b, a, c) {
	today = new Date;
	timeold = 1E3 * d - today.getTime() + timeDiff;
	0 > timeold ? "undefined" != typeof dingdong && (!0 == dingdong && "undefined" != typeof c) && (dingdong = !1, tuan_start()) : ("undefined" != typeof c ? setTimeout("show_date_time(" + d + "," + b + "," + a + "," + c + ")", 100) : setTimeout("show_date_time(" + d + "," + b + "," + a + ")", 100), sectimeold = timeold / 1E3, secondsold = Math.floor(sectimeold), msPerDay = 864E5, e_daysold = timeold / msPerDay, daysold = Math.floor(e_daysold), e_hrsold = 24 * (e_daysold - daysold), hrsold = Math.floor(e_hrsold), e_minsold = 60 * (e_hrsold - hrsold), minsold = Math.floor(60 * (e_hrsold - hrsold)), e_seconds = 60 * (e_minsold - minsold), seconds = Math.floor(60 * (e_minsold - minsold)), ms = e_seconds - seconds, ms = new String(ms), ms1 = ms.substr(2, 1), ms2 = ms.substr(2, 2), hrsold1 = 24 * daysold + hrsold, 1 == b ? $("#end_date_" + a).html("<em>" + (10 > hrsold1 ? "0" + hrsold1: hrsold1) + "</em>\u5c0f\u65f6<em>" + (10 > minsold ? "0" + minsold: minsold) + "</em>\u5206<em>" + (10 > seconds ? "0" + seconds: seconds) + "</em>\u79d2") : 2 == b ? $("#end_date_" + a).html("<em>" + daysold + "</em>\u5929<em>" + (10 > hrsold ? "0" + hrsold: hrsold) + "</em>\u65f6<em>" + (10 > minsold ? "0" + minsold: minsold) + "</em>\u5206<em>" + (10 > seconds ? "0" + seconds: seconds) + "</em>\u79d2") : 3 == b ? $("#end_date_" + a).html("<em>" + (10 > hrsold1 ? "0" + hrsold1: hrsold1) + "</em>\u5c0f\u65f6<em>" + (10 > minsold ? "0" + minsold: minsold) + "</em>\u5206<em>" + (10 > seconds ? "0" + seconds: seconds) + "." + ms1 + "</em>\u79d2") : 4 == b ? $(".end_date_" + a).html("<em class='h'>" + (10 > hrsold1 ? "0" + hrsold1: hrsold1) + "</em><em class='m'>" + (10 > minsold ? "0" + minsold: minsold) + "</em><em class='s'>" + (10 > seconds ? "0" + seconds: seconds) + "." + ms1 + "</em>") : $("#end_date_" + a).html(daysold + "\u5929" + (10 > hrsold ? "0" + hrsold: hrsold) + "\u5c0f\u65f6" + (10 > minsold ? "0" + minsold: minsold) + "\u5206" + (10 > seconds ? "0" + seconds: seconds) + "\u79d2." + ms2))
}
function tuan_start() {
	var d, b = /^[0-9]+$/;
	d = $.ajax({
		type: "GET",
		url: window.location.herf,
		success: function() {
			var a = (new Date(d.getResponseHeader("Date"))).getTime(),
			c = a - 1E3 * endTime;
			b.test(a) && 0 < c ? tuan_pop() : setTimeout("tuan_pop()", c)
		}
	})
}
function tuan_pop() {
	1 == $(".tuan-intro").length && $(".tuan-intro").parents(".wrapper").remove();
	1 == $(".overlay").length && $(".overlay").remove();
	$("body").prepend('<div id="overlay" class="overlay"></div>');
	$("#head").after('<div class="wrapper" style="position: relative;z-index:10000" ><div class="tuan-intro" style="background-image: url(http://s0.mizhe.cn/image/tuan/kickoff.png);"><a class="addF" style="top: 215px;left: 165px;" title="\u7acb\u5373\u53bb\u62a2\u8d2d" href="javascript:void(0);">&nbsp;</a></div></div>');
	if (isIE6) {
		var d = $("body").height(),
		b = $("body").width();
		$(".overlay").css({
			height: d,
			width: b,
			display: "block"
		})
	}
	$(".tuan-intro").fadeIn(function() {
		$(".tuan-intro .addF").click(function(a) {
			a.preventDefault();
			$(".tuan-intro").parents(".wrapper").remove();
			$(".overlay").fadeOut(function() {
				$(this).remove()
			});
			window.location = window.location
		})
	})
}
function bindScroll(d) {
	$(d).infinitescroll({
		navSelector: "#more",
		nextSelector: "#more a",
		itemSelector: ".tuan-item",
		bufferPx: 850,
		state: {
			currPage: $("#curr-page").val()
		},
		pathParse: [$("#path-parse").val(), ".html"],
		loading: {
			img: "http://s0.mizhe.cn/image/icons/white-ajax-loader.gif",
			msgText: "\u6b63\u5728\u52a0\u8f7d...",
			finishedMsg: "\u563f\u563f\uff0c\u597d\u50cf\u6ca1\u6709\u4e86"
		},
		errorCallback: function() {
			0 < $(".pagination").length && $(".pagination").show()
		}
	},
	function(b) {
		var a = $(b),
		c = a.length;
		if (39 > c || $(a[c - 1]).hasClass("stop")) 0 < $(".pagination").length && $(".pagination").show(),
		$(window).unbind(".infscr");
		$(".infinite-scroll .tuan-list ul").append(b);
		0 != c % 3 && !$(a[c - 1]).hasClass("stop") && (b = 3 - c % 3, $(".infinite-scroll .tuan-list ul li:first").clone(!0).removeClass(" line-first").appendTo($(".infinite-scroll .tuan-list ul")), 1 < b && $(".infinite-scroll .tuan-list ul li:first").next().clone(!0).appendTo($(".infinite-scroll .tuan-list ul")));
		a.imagesLoaded(function() {
			lazyLoadImg();
			C(".lazy-img img", !0).run("lazyimg", {
				Furl: function(a) {
					return a = $.mz.decodeTbUrl(a)
				}
			})
		});
		a = $("#num_iids").val();
		b = $("#outer_code").val();
		$("#num_iids").remove();
		$("#outer_code").remove();
		_items_convert(a, b, batch_item_callback)
	})
};