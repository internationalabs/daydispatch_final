document.addEventListener("DOMContentLoaded", function () {
    var e = document.querySelectorAll('[data-plugin="choices"]');
    e && Array.from(e).forEach(function (e) {
        new Choices(e, {
            placeholderValue: "This is a placeholder set in the config",
            searchPlaceholderValue: "Search results here"
        })
    })
});
var CheckoutTab = document.querySelectorAll(".checkout-tab");
CheckoutTab && Array.from(document.querySelectorAll(".checkout-tab")).forEach(function (o) {
    o.querySelectorAll(".nexttab") && Array.from(o.querySelectorAll(".nexttab")).forEach(function (t) {
        var e = o.querySelectorAll('button[data-bs-toggle="pill"]');
        e && (Array.from(e).forEach(function (e) {
            e.addEventListener("show.bs.tab", function (e) {
                e.target.classList.add("done")
            })
        }), t.addEventListener("click", function () {
            var e = t.getAttribute("data-nexttab");
            e && document.getElementById(e).click()
        }))
    });
    document.querySelectorAll(".previestab") && Array.from(o.querySelectorAll(".previestab")).forEach(function (r) {
        r.addEventListener("click", function () {
            var e = r.getAttribute("data-previous");
            if (e) {
                var t = r.closest("form").querySelectorAll(".custom-nav .done").length;
                if (t) {
                    for (var o = t - 1; o < t; o++) r.closest("form").querySelectorAll(".custom-nav .done")[o] && r.closest("form").querySelectorAll(".custom-nav .done")[o].classList.remove("done");
                    document.getElementById(e).click()
                }
            }
        })
    });
    var r = o.querySelectorAll('button[data-bs-toggle="pill"]');
    r && Array.from(r).forEach(function (e, t) {
        e.setAttribute("data-position", t), e.addEventListener("click", function () {
            0 < o.querySelectorAll(".custom-nav .done").length && Array.from(o.querySelectorAll(".custom-nav .done")).forEach(function (e) {
                e.classList.remove("done")
            });
            for (var e = 0; e <= t; e++) r[e].classList.contains("active") ? r[e].classList.remove("done") : r[e].classList.add("done")
        })
    })
});
