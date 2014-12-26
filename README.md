Elemonators.com
===============

A web based game developed for 3rd year project.

<html>
<head>
    <link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>">
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/2.1.0/jquery.min.js"></script>
	
    <script> 	
	$(document).ready(function(){
    $("#Informationhead").click(function(){
    $("#Information").slideToggle("fast");
    });
    });
    </script>
    <script type="text/javascript">
    window.twttr=(function(d,s,id){var t,js,fjs=d.getElementsByTagName(s)[0];
    if(d.getElementById(id)){return}js=d.createElement(s);js.id=id;js.src="https://platform.twitter.com/widgets.js";
    fjs.parentNode.insertBefore(js,fjs);return window.twttr||(t={_e:[],ready:function(f){t._e.push(f)}})}(document,"script","twitter-wjs"));
    </script>
    <script type="text/javascript">
    var game = { //game object
    level: 1, //current level
    turn: 0, //current turn
    difficulty: 1, // user difficulty
    score: 0, //current score
    active: false, //whether a turn is active or not
    handler: false, // whether the click and sound handlers are active
    shape: '.shape', // cached string for the pad class
    genSequence: [], //array containing the generated/randomized pads
    plaSequence: [], //array containing the users pad selections
    colors: ['Green', 'Red', 'Yellow', 'Blue'],
    init: function () { //initialises the game
        if (this.handler === false) { //checks to see if handlers are already active
            this.initPadHandler(); //if not activate them
        }
        this.newGame(); //reset the game defaults

    },

    initPadHandler: function () {

        that = this;

        $('.pad').on('mouseup', function () {

            if (that.active === true) {

                var pad = parseInt($(this).data('pad'), 10);

                that.flash($(this), 1, 300, pad);

                that.logPlayerSequence(pad);

            }
        });

        this.handler = true;

    },

    newGame: function () { //resets the game and generates a starts a new level

        this.level = 1;
        this.score = 0;
        this.newLevel();
        this.displayLevel();
        this.displayScore();

        //initialize timer to 10 seconds (10.0)
        this.timer = 10;

    },

    newLevel: function () {

        this.genSequence.length = 0;
        this.plaSequence.length = 0;
        this.pos = 0;
        this.turn = 0;
        this.active = true;

        this.randomizePad(this.level); //randomize pad with the correct amount of numbers for this level
        this.displaySequence(); //show the user the sequence
    },

    flash: function (element, times, speed, pad) { //function to make the pads appear to flash

        var that = this; //cache this

        if (times > 0) { //make sure we are supposed to flash
            that.playSound(pad); //play the corresponding pad sound
    		
			if ($("#flash").is(":checked")) {//Check Box Function
            element.stop().animate({
                opacity: '1'
            }, { //animate the element to appear to flash
                duration: 50,
                complete: function () {
                    element.stop().animate({
                        opacity: '0.6'
                    }, 200);
                }
            }); //end animation

        }
		

        if (times > 0) { //call the flash function again until done the correct amount of times 
            setTimeout(function () {
                that.flash(element, times, speed, pad);
            }, speed);
            times -= 1; //times - 1 for each time it's called
        }
		}
    },
    ////////////////////////////////////////////////////////////////////////////////////////////////////////////
    playSound: function (clip) { //plays the sound that corresponds to the pad chosen
        if ($("#sound").is(":checked")) {//Check Box Function
            var sound = $('.sound' + clip)[0];
            console.log(sound);
            console.log($('.sound' + clip));
            sound.currentTime = 0; //resets audio position to the start of the clip
            sound.play(); //play the sound
	    $('[data-action=sound]').html(sound);
		}
    },

    randomizePad: function (passes) { //generate random numbers and push them to the generated number array iterations determined by current level

        for (i = 0; i < passes; i++) {

            this.genSequence.push(Math.floor(Math.random() * 4) + 1);

        }
    },

    logPlayerSequence: function (pad) { //log the player selected pad to user array and call the checker function

        this.plaSequence.push(pad);
        this.checkSequence(pad);


    },

    checkSequence: function (pad) { //checker function to test if the pad the user pressed was next in the sequence

        that = this;

        if (pad !== this.genSequence[this.turn]) { //if not correct 

            this.incorrectSequence();

        } else { //if correct
            this.keepScore(); //update the score
            this.turn++; //incrememnt the turn

        }

        if (this.turn === this.genSequence.length) { //if completed the whole sequence

            this.level++; //increment level, display it, disable the pads wait 1 second and then reset the game
            this.displayLevel();
            this.active = false;

            // Stop counting when sequence is correct to avoid time running out before starting next level
            clearInterval(this.timerInterval);

            //Add 5.0 seconds each 5th level
            this.timer = 10 + 5 * Math.floor(this.level / 5);

            //Update timerdisplay to show fulltime while displaying next level sequence
            $(".Timer p").html(this.timer);

            setTimeout(function () {
                that.newLevel();
            }, 1000);
        }
    },

    // Countdown and update timer, call incorrectsequence when time's up
    countDown: function () {
        this.timer -= 0.1;
        $(".Timer p").html(this.timer.toFixed(1)); // Display 9.0 instad of 9
        if (this.timer < 0.1) {
            this.incorrectSequence();
        }
    },

    displaySequence: function () { //display the generated sequence to the user

        var that = this;

        var timerCount = 0;

        $.each(this.genSequence, function (index, val) { //iterate over each value in the generated array
            timerCount = index;
            setTimeout(function () {

                that.flash($(that.shape + val), 1, 300, val);
				if ($("#text").is(":checked")) {//Check Box Function
				
                $(".TextBox").children(":first").html('<b>' + (index + 1) + " : " +that.colors[val-1]+'</b>');
				}
            }, 500 * index * that.difficulty); // multiply timeout by how many items in the array so that they play sequentially and multiply by the difficulty modifier
			
        });

        // Wait to start timer until full sequence is displayed
        setTimeout(function () {
            that.timerInterval = setInterval(function () {
                that.countDown()
            }, 100)

            setTimeout(function () {
                $(".TextBox").children(":first").html('');
            }, 500);
        }, 500 * timerCount * that.difficulty);
    },

    displayLevel: function () { //just display the current level on screen

        $('.level h2').text('Level: ' + this.level);

    },

    displayScore: function () { //display current score on screen
        $('.score h2').text('Score: ' + this.score);
    },

    keepScore: function () { //keep the score

        var multiplier = 0;

        switch (this.difficulty) //choose points modifier based on difficulty
        {
            case '2':
                multiplier = 1;
                break;

            case '1':
                multiplier = 2;
                break;

            case '0.5':
                multiplier = 3;
                break;

            case '0.25':
                multiplier = 4;
                break;
        }

        this.score += (1 * multiplier); //work out the score

        this.displayScore(); //display score on screen
    },

    incorrectSequence: function () { //if user makes a mistake	

        //Stop counting down timer and display start message
        clearInterval(this.timerInterval);
        $(".Timer p").html("<b>Game Over</b>");

        var corPad = this.genSequence[this.turn], //cache the pad number that should have been pressed

            that = this;
        this.active = false;
        this.displayLevel();
        this.displayScore();

        setTimeout(function () { //flash the pad 4 times that should have been pressed
            that.flash($(that.shape + corPad), 4, 300, corPad);
        }, 500);

        $(".TextBox").children(":first").html("<b>The Right Answer was  " + that.colors[corPad - 1] + " Try Again </b>");

        $('.start').show(); //enable the start button again and allow difficulty selection again
        $('.difficulty').show();
		
			//Offer the User a JavaScript alert box to post there score to twitter 			
if (window.confirm("You scored: "  +this.score+ " points on the E-Lemon-Ators Memory Game \nShare this on Twitter?"))
{
    window.location.href = "http://twitter.com/home?status=" + "I just scored " + this.score +  " points on the E-Lemon-Ators Memory game! Think you have a better memory, Try and beat me? (via www.e-lemon-ators.com)"
}
else
{
    // They clicked no 
}

    }

};
$(document).ready(function () { //document ready

    $('.start').on('mouseup', function () { //initialise a game when the start button is clicked
        $(this).hide();
        game.difficulty = $('input[name=difficulty]:checked').val();
        $('.difficulty').hide();
        game.init();


    });
	});
	</script>
</head>
<body>

<!-- This is the part you add in the html -->
    <br />
    <center><div class="logo"></div></center>
	<br />
<!-- This is were it ends -->
	
	<div class="Informationhead"id="Informationhead"><h3 style="color:white;"><b>Information and Our Goal</b></h3></div>
	<div class="Information"id="Information">
	<h2><i>Welcome to the E-lemon-ators Memory Game</i></h2>
	<div class="InfoText"><p><b>Better memory will improve your focus, problem solving, and multitasking skills. It will also help to control all kinds of distractions and keep your impulses in check. As little as 5 minutes per day of brain training can yield significant results. Brain training is just like muscle training - the more you train, the better results you get! This game is your perfect memory exerciser it is suitable for kids, students, adults, and seniors!
    Don't be surprised if you do better on your next IQ test or brain age test. These type of games are a scientifically proven way to boost your brain power and health not only that, they also reduce the risk of memory loss (dementia) with older adults.
    The game will help students and business professionals alike - whether it's a client's name or a more polished presentation, or studying for an exam. The results will be quickly noticed.</i></b></p>
	<p><b>We the E-lemon-ators want to help you improve you memory with our game which is designed around the 3 different ways you can retain information, Sight, Sound and Reading. Each user can set there game up they way the want for the best result</b></p>
	</div>
    <p><b>Please Help Us, Help others by spreading our message</b></p>
	<a class="twitter-share-button"
    href="https://twitter.com/share"
    data-url="https://www.E-lemon-ators.com"
    data-text="Getting Better Memory Thanks to The E-lemon-ators Memory Game! Think you can do better,Try beat me?"
    data-count="horizontal">
    </a>
	</div>
	
	
