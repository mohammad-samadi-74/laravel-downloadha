$(document).ready(function () {
    $(window).resize(function () {
        $("#navigation .navbar-toggler")
            .addClass("collapsed")
            .attr("aria-expanded", "false");
        $("#main_navigation").removeClass("show");
        $("#socials_down_navigation").removeClass("show");
    });

    $(window).scroll(function (event) {
        if ($(this).scrollTop() >= 242)
            $("#fixed-navigation-menu").addClass("fixed-top");
        else $("#fixed-navigation-menu").removeClass("fixed-top");
    });

    $("#searchBox input").keydown(function () {
        if (event.keyCode === 13) {
            $("#searchBox a").click();
        }
    });

    //search box
    if ($("#search-input").val() !== "") {
        $("#searchBox").css({ width: "260px" });
    }

    $("#searchBox")
        .on("mouseenter", function () {
            $("#searchBox").css({ width: "260px" });
        })
        .on("mouseleave", function () {
            if ($("#search-input").val() === "") {
                $("#searchBox").css({ width: "40px" }, 1000);
            }
        });

    // change them
    $("#changeThemInput").val(true);
    $("#changeThemInput").change(function () {
        let label = $("#changeThem label");
        if (this.checked) {
            label.html("<i class='fas fa-sun text-yellow'></i>");
        } else {
            label.html("<i class='fas fa-moon text-dark'></i>");
        }
    });
});
