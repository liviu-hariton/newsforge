import './bootstrap';

import "./frontend/plugins/jquery/jquery.js";

(function($,d){$.each(readyQ,function(i,f){$(f)});$.each(bindReadyQ,function(i,f){$(d).bind("ready",f)})})(jQuery,document)

import "./frontend/plugins/slick-carousel/slick.min.js";

import "./frontend/plugins/jquery-validation/dist/jquery.validate.min.js";
import "./frontend/plugins/jquery-validation/dist/additional-methods.js";

import "./frontend/js/custom.js";
