"use strict";

const classMappings = {
  "hat.png": "hat",
  "eyes.png": "eyes",
  "nose.png": "nose",
  "mouth.png": "mouth",
};

$(document).ready(function () {
  // organization is poor I know ¯\_(ツ)_/¯, next time.
  const musicToggle = $("#music-toggle");
  const music = $("#bg-music");
  const help = $("#help-text");
  const body = $(".body");
  const gameFunctions = $(".game-item");
  music.volume = 0.5;
  musicToggle.hide();
  const partsContainer = $("#parts-container");
  partsContainer.hide();
  musicToggle.addClass("btn-danger");
  window.bgAnimateForwards = true;
  gameFunctions.hide();

  const bodyParts = $(".body-part");
  bodyParts.fadeOut();

  $(".body-part").click((el) => {
    const part = $(el.target);
    part.fadeOut();
    const cloned = part.clone();
    const src = el.target.src.split("/");
    cloned.removeClass(["body-part", "col-3"]);
    cloned.addClass(classMappings[src[src.length - 1]]);
    cloned.hide();
    $(".operatin-table").append(cloned);
    cloned.fadeIn();
    if (part.siblings().length === part.siblings(":hidden").length)
      partsContainer.fadeOut();
  });

  $("#start-button").click((el) => {
    $(el.target).fadeOut();
    help.fadeOut();
    musicToggle.fadeIn();
    const audio = document.getElementById("bg-music");
    audio.volume = 0.2;
    audio.play();
    body.css("opacity", "1");
    gameFunctions.fadeIn();
    $("#photo-cont").hide();
    $("#parts-container").fadeIn();
    bodyParts.fadeIn();

    $("body").animate(
      {
        "background-position-x": `60%`,
      },
      5000
    );

    window.setInterval(function () {
      const position = window.bgAnimateForwards ? "80%" : "50%";
      $("body").animate(
        {
          "background-position-x": position,
        },
        5000
      );
      window.bgAnimateForwards = !window.bgAnimateForwards;
    }, 5000);
  });

  musicToggle.click(() => {
    const audio = document.getElementById("bg-music");
    if (musicToggle.text() === "Pause Music") {
      musicToggle.text("Play Music");
      musicToggle.removeClass("btn-danger");
      audio.pause();
    } else {
      musicToggle.text("Pause Music");
      musicToggle.addClass("btn-danger");
      audio.play();
    }
  });

  const shrink = $(".shrink-image");
  shrink.click(() => {
    const image = $(".fullsc");
    image.removeAttr("style");
    image.css("height", "25%");
    image.css("width", "25%");
    image.removeClass("fullsc");
    $(".download-btn").fadeOut();
    shrink.fadeOut();
  });
});

const capture = () => {
  $("#photo-cont").fadeIn();
  const captureElement = document.querySelector(".operatin-table");
  html2canvas(captureElement, { allowTaint: true })
    .then((canvas) => {
      canvas.style.display = "none";
      canvas.style.height = "25%";
      canvas.style.width = "25%";
      document.getElementById("photos").appendChild(canvas);
      return canvas;
    })
    .then((canvas) => {
      $(canvas).addClass("screenshot");
      $(canvas).attr("crossOrigin", "Anonymous");
      // Hover to fullscreen
      $(canvas).hover(
        function () {
          if ($(".fullsc").length === 0) {
            $(this).addClass("fullsc");
            $(this).animate(
              {
                top: "0",
                left: "30%",
                height: "100%",
                width: "40%",
              },
              1000,
              () => {
                $(".shrink-image").fadeIn();
                const dBtn = $(".download-btn");
                const image = this.toDataURL("image/png");
                dBtn.attr("download", "newPotatoIdentity.png");
                dBtn.attr("href", image);
                dBtn.fadeIn();
              }
            );
          }
        },
        function () {
          // Do nothing on mouse leave cause we dont need it i guess
        }
      );
      $("canvas").fadeIn();
    });
};
