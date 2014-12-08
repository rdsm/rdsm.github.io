		var interval;
		var status = false;
		function toggleCharms(timer) {
			var days = ['Sunday','Monday','Tuesday','Wednesday','Thursday','Friday','Saturday'];
			var months = ['January','February','March','April','May','June','July','August','September','October','November','December'];
			var setTime = function() {
				var now = new Date();
				var h, m;
				if(now.getHours() == 0)
					h = 12;
				else if(now.getHours() > 12)
					h = now.getHours() - 12;
				else
					h = now.getHours();
				if(now.getMinutes() < 10)
					m = "0" + now.getMinutes();
				else
					m = now.getMinutes();
				$(".day-of-week").text(days[now.getDay()]);
				$(".today").text(months[now.getMonth()] + " " + now.getDate());
				$("#time").text(h + ":" + m);
			}
			if(status == "true" || status == true) {
				clearInterval(timer);
				$("#datebox").fadeOut(250);
				$("#charms").animate({right: '-=96px'}, 250, 'easeOutExpo');
				$("#charms ul li").animate({right: '-=80'}, 200, 'linear');
				status = false;
			}
			else {
				setTime();
				setInterval(setTime, 1000);
					$("#datebox").fadeIn(150);
					$("#charms").animate({right: '+=96px'}, 250, 'easeOutExpo');
					timer = setTimeout(function() {
					var len = $("#charms ul li").length;
					var i = Math.floor(len/2);
					var wait = 0;
					while(i >= 0) {
						$("#charms ul li").eq(i).delay(wait).animate({right: '+=80'}, 400, 'easeOutExpo');
						if(i != Math.floor(len/2))
							$("#charms ul li").eq(len-1-i).delay(wait).animate({right: '+=80'}, 400, 'easeOutExpo');
						i--;
						wait += 50;
					}
				}, 50);
				status = true;
			}
		}
		$(document).ready(function() {
			$(".activateCharms").on('click', function() { toggleCharms(interval); });
			$(document).keypress(function(e) {
				if(e.charCode == 99) {
					toggleCharms(interval);
				}
			});
		});
