<!DOCTYPE html>
<html lang="en" dir="ltr">
    <head>
        <meta charset="utf-8">
        <title>Vue.JS GIPHY API In-Class Example</title>
<!-- Bulma -->
        <link rel="stylesheet" type="text/css"  href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.7.5/css/bulma.min.css">

        <style type="text/css">
            .input {
                margin-bottom: 1rem;
            }

            button.input {
                text-align: center;
                justify-content: center;
            }

            ul.columns{
                flex-wrap: wrap;
            }

            ul .is-full{
                display: block;
                width: 100%;
            }

            p {
                padding: 1rem: 0;
            }

            a {
                display: inline-block;
                transition: 0.3s ease all;
            }

            a:hover {
                transform: scale(1:1);
            }

        </style>
    </head>
    <body>

        <div id="giphy-search-container">
            <giphy-results></giphy-results>
        </div>

<!-- Search HTML -->
        <script type="text/javascript" src="https://unpkg.com/axios/dist/axios.min.js">

        </script>

<!-- Vue -->
        <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js">

        </script>

<!-- Our Scripts: -->
        <script type="text/javascript" defer>

            // Giphy API key
            var myGiphyAPIKey = 'yb7EkGKFtd6q7molvP5YMr34LiqK58D5';

            Vue.component( 'giphy-results', {
                data: function () {
                    return {
                        apptitle: 'Vue.JS GIPHY API In-Class Example',
                        searchterm: '',
                        giphyResults: {},
                        isList: false
                    }
                },
                methods: {
                    giphySearch ( term )
                    {
                        axios.get( 'https://api.giphy.com/v1/gifs/search?api_key='+myGiphyAPIKey+'&q='+this.searchterm )
                              .then( response => {
                                  this.giphyResults = response.data.data;
                             } );
                    },
                    toggleListView ()
                    {
                        this.isList = !this.isList;
                    },
                    giphyImage (images)
                    {
                        if ( this.isList === true )
                        {
                            return images.original.url;
                        }
                        else {
                        {
                            return images.fixed_width.url;
                        }
                        }
                    }
                },
                template: `
                    <div id="giphy-results">
                        <h1 v-text="apptitle" class="title is-1"></h1>
                        <form @submit.prevent="giphySearch">
                            <input v-model="searchterm" type="search" class="input" placeholder="Enter a Search Term.">
                            <input type="submit" value="Submit Search" class="input">
                            <button @click="toggleListView" class="input has-text-centered">Toggle Grid/List View</button>
                        </form>
                        <p>Current Search Term: {{ searchterm }}</p>
                        <ul class="columns">
                            <li v-for="gif in giphyResults" class="column" v-bind:class="{ 'is-full' : isList, 'is-one-quarter' : !isList }">
                                <a v-bind:href="gif.url" target="_blank">
                                    <img v-bind:src="giphyImage(gif.images)"
                                    v-bind:alt="gif.slug">
                                </a>
                            </li>
                        </ul>
                    </div>
                `
            } );

            // Initiate Vue instance for search container
            var giphySearch = new Vue( {
                el: '#giphy-search-container'
            });
        </script>

    </body>
</html>
