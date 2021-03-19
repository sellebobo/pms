/************ css *****************/

import "../css/fontawesome.css";
import "../css/icofont.css";
import "../css/themify.css";
import "../css/feather-icon.css";
import "../css/animate.css";
import "../css/whether-icon.css";
import "../css/ionic-icon.css";
import "../css/bootstrap.css";
import "../css/color-1.css";
import "../css/responsive.css";
import "../styles/admin.css";
import "pixeden-stroke-7-icon";
import "select2/dist/css/select2.css";
import "@fortawesome/fontawesome-free/css/all.css";
import "../css/style.css";

import $ from "jquery";
import popper from "popper.js";

global.$ = global.jQuery = $;
global.popper = global.Popper = popper;

require("bootstrap");
require('@fortawesome/fontawesome-free/js/all.js');
const feather = require("feather-icons");
import "./sidebar-menu.js";
import "./config.js";
import "./script.js";

import "select2";
import "pdfmake";
import "datatables.net-bs4";
import "datatables.net-autofill-bs4";
import "datatables.net-buttons-bs4";
import "datatables.net-buttons/js/buttons.colVis.js";
import "datatables.net-buttons/js/buttons.flash.js";
import "datatables.net-buttons/js/buttons.html5.js";

import jsZip from "jszip";
import * as pdfFonts from "pdfmake/build/vfs_fonts";

window.JSZip = jsZip;
pdfMake.vfs = pdfFonts.pdfMake.vfs;
feather.replace();

import "./Components/banque.js";
import "./Components/employe.js";
import "./Components/client.js";

(function ($) {
  "use strict";
  var tooltip_init = {
    init: function () {
      $("button").tooltip();
      $("a").tooltip();
      $("input").tooltip();
      $("img").tooltip();
    },
  };
  tooltip_init.init();

  if ($(".select2").length > 0) {
    $(".select2").select2();
  }
})(jQuery);
