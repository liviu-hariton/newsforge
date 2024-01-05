import './bootstrap';

import "./frontend/plugins/jquery/jquery.js";

(function($,d){$.each(readyQ,function(i,f){$(f)});$.each(bindReadyQ,function(i,f){$(d).bind("ready",f)})})(jQuery,document)

import "./frontend/plugins/slick-carousel/slick.min.js";

import "./frontend/js/custom.js";
