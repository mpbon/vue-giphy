<!DOCTYPE html>
<html lang="en" dir="ltr">
    <head>
        <meta charset="utf-8">
        <title>Vue.JS Rock Paper Scissors In-Class Example</title>
<!-- Bulma -->
        <link rel="stylesheet" type="text/css"  href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.7.5/css/bulma.min.css">

        <style media="screen">
            body {
                text-align: center;
                padding-top: 2%;
            }

            h1 {
                padding-bottom: 2%;
                font-size: 50px;
            }

            form {
                padding-bottom: 1%;
            }

        </style>
    </head>
    <body>


<!-- Rock paper scissors HTML -->
        <div id="rps-container">
            <rock-paper-scissors></rock-paper-scissors>
        </div>

<!-- Vue -->
        <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js">

        </script>

<!-- Our Scripts: -->
        <script type="text/javascript" defer>

            Vue.component( 'rock-paper-scissors', {
                data: function () {
                    return {
                        appTitle: 'Rock Paper Scissors Game (Vue!)',
                        playerHand: '',
                        computerHand: '',
                        playerScore: 0,
                        computerScore: 0,
                        gameMessage: 'Choose rock, paper, or scissors to begin!'
                    }
                },
                methods: {
                    setComputerHand()
                    {
                        //get random integer 1-3
                        var randOneToThree = Math.floor( (Math.random() * 3 ) + 1 );

                        //Rock
                        if ( randOneToThree == 1 )
                        {
                            this.computerHand = 'rock';
                        }

                        //Paper
                        else if ( randOneToThree == 2 )
                        {
                            this.computerHand = 'paper';
                        }

                        //Scissors
                        else
                        {
                            this.computerHand = 'scissors';
                        }
                    },
                    playGame()
                    {
                        this.setComputerHand();
                        //handle a tie
                        if ( this.playerHand === this.computerHand )
                        {
                            this.gameMessage = 'Tie game! No Point.';
                        }
                        //handle player wins scenerio
                        else if (
                            ( this.computerHand === 'rock' && this.playerHand === 'paper' )
                            ||
                            ( this.computerHand === 'paper' && this.playerHand === 'scissors' )
                            ||
                            ( this.computerHand === 'scissors' && this.playerHand === 'rock' )
                        )
                        {
                            this.gameMessage = 'Player wins this round!';
                            this.playerScore++;
                        }
                        //handle computer wins scenerio
                        else
                            {
                                this.gameMessage = 'Computer wins this round! Machines shall inherit the earth!';
                                this.computerScore++;
                            }
                    }
                },
                template:`
                <div id="container">
                    <div id="rps">
                        <h1 v-text="appTitle"></h1>
                        <form @submit.prevent="playGame">
                            <input @click="playerHand='rock'" value="Rock" type="submit">
                            <input @click="playerHand='paper'" value="Paper" type="submit">
                            <input @click="playerHand='scissors'" value="Scissors" type="submit">
                        </form>
                        <p>
                            Game Status:
                            <span v-text="gameMessage"></span>
                        </p>
                        <p>
                            Player Hand:
                            <span v-text="playerHand"></span>
                            Player Score:
                            <span v-text="playerScore"></span>
                        </p>
                        <p>
                            Computer Hand:
                            <span v-text="computerHand"></span>
                            Computer Score:
                            <span v-text="computerScore"></span>
                        </p>
                    </div>
                    </div>
                `
            });

            var rpsGame = new Vue( {
                el: '#rps-container'
            });

        </script>

    </body>
</html>
