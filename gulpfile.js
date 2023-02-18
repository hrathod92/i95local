var elixir = require( 'laravel-elixir' );
elixir( function(mix) { 
  mix
  .sass( 'app.scss', './public/css/app.css' )
  .sass( 'pages/dashboard.scss', './public/css/pages/dashboard.css' )
  .sass( 'pages/home.scss', './public/css/pages/home.css' )
  .sass( 'pages/users.scss', './public/css/pages/users.css' )
  .sass( 'pages/user-login.scss', './public/css/pages/user-login.css' )
  .sass( 'pages/user-create.scss', './public/css/pages/user-create.css' )
});
 