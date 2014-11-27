$(function() {
	var startImageBox = $("#mario-start"),
		animationImageBox = $("#mario-animation"),
		animationImage = $("#mario-animation-img"),
		amountBox = $("#amount"),
		amount = 0.0,
		jumpSound = new Audio("images/jump.wav"),
		coinSound = new Audio("images/coin.wav"),
		coinSound2 = new Audio("images/coin.wav"),
		currentCoinSound = true;
	
	function enableSubmit() {
		if (amount > 0 && $("input[name='name']").val().length !== 0) {
			$("button[type='submit']").prop('disabled', false);
		}
	}

	function updateAmount(newAmount) {
		amount = newAmount;
		$("#savedAmount").val(newAmount);
		amountBox.text(newAmount.toFixed(2));
	}
	
	$("#jumper").click(function() {
		if (startImageBox.is(":visible")) {
			startImageBox.hide();
			animationImageBox.show();
		}

		setTimeout(function() {
			animationImage.attr('src', animationImage.attr('src'));
			jumpSound.play();
			setTimeout(function() {
				currentCoinSound++;
				if (currentCoinSound % 2 === 0) {
					coinSound.play();
				} else {
					coinSound2.play();
				}
				
				setTimeout(function() {
					updateAmount(amount + 0.25);
					enableSubmit();
					
				}, 300);
			}, 200);
		}, 10);
	});

	$("#resetamount").click(function() {
		var img = this;

		setTimeout(function() {
			updateAmount(0);
		}, 500);

		this.src = "images/resetamount.gif";
		setTimeout(function() {
			img.src = "images/resetamount-start.gif";
		}, 700);
	});
	
	$("input[name='name']").change(function() {
		enableSubmit();
	});

	$("#openSponsors").click(function() {
		$("#currentSponsors").removeClass("hidden");
		$("#sponsorOpener").hide();
	});
});