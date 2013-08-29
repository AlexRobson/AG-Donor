/*$(window).load(function() {
        var total = $("#img_box img").length;


        $(".thumblink").click(function() {

            var imgnumber = parseInt($(this).attr('id').replace("imglink", ""));
            var move = -($("#img"+imgnumber).width() * (imgnumber - 1));

            $("#img_box").animate({
                left: move
            }, 888);

            $("#imgthumb_box").find("img").removeAttr("style");
            $(this).find("img").css({
                "border-color": "#0099cc",
                "top": "-5px",
                "border-top-width": "-5px"
            });
            return false;
        });
				
				$("#imgthumb_box a:first").addClass("active");
				$('#imgthumb_box a').click(function() {
				$('#imgthumb_box a').each(function(){
					$(this).removeClass('active')
				})
					$(this).addClass('active');
				});
				
				var buttons = $('#imgthumb_box span').length;				
				
				$('a#linkprev').click(function() {						
					if($('#imgthumb_box a.active').attr('id').replace("imglink", "") > 1) {
						$('#imgthumb_box a.active').removeClass('active').parent().prev().find('a').addClass('active');
					}
				});
				
				$('a#linknext').click(function() {										
					if($('#imgthumb_box a.active').attr('id').replace("imglink", "") < buttons) {
						$('#imgthumb_box a.active').removeClass('active').parent().next().find('a').addClass('active');
					}
				});
				

        $("#navigate a").click(function() {
						
            var imgwidth = $("#img1").width();
            var box_left = $("#img_box").css("left");
            var el_id = $(this).attr("id");
            var move, imgnumber;
						
            if (box_left == 'auto') {
                box_left = 0;
            } else {
                box_left = parseInt(box_left.replace("px", ""));
            }

            // if prev
            if (el_id == 'linkprev') {
                if ((box_left - imgwidth) == -(imgwidth)) {
                    move = -(imgwidth * (total - 1));
                } else {
                    move = box_left + imgwidth;
                }

                imgnumber = -(box_left / imgwidth);
                if (imgnumber == 0) {
										return false;
                    //imgnumber = total;
                }
            } else if (el_id == 'linknext') {
                // if in the last image, move to first
                if (-(box_left) == (imgwidth * (total - 1))) {
                    move = 0;										
                } else {										
                    move = box_left - imgwidth;
                }

                imgnumber = Math.abs((box_left / imgwidth)) + 2;
                if (imgnumber == (total + 1)) {
											return false;
                    //imgnumber = 1;
                }
            }
            $("#navigate a").hide();
            $("#navigate span").show();

            $("#img_box").animate({
                left: move+'px'
            }, 800, function() {
                $("#navigate a").show();
                $("#navigate span").hide();
            });

            return false;
        });
				
				$("#imgthumb_box span:last").addClass('last');
    });*/