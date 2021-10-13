<!doctype html>
<html>
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="/jokes.css">
    <title><?=$title?></title>
  </head>
  <body>
  <nav>
    <header>
      <h1>Internet Joke Database</h1>
    </header>
    <ul>
      <li><a href="/">Home</a></li>
      <li><a href="/joke/list">Jokes List</a></li>
      <li><a href="/category/list">Category List</a></li>
      <?php
      if (!isset($_SESSION['loggedin'])){ ?>
        <li><a href="/author/register">Register</a></li>
        <li><a href="/author/login">Login</a></li>
      <?php } 
      else { ?>
        <li><a href="/joke/edit">Add a new Joke</a></li>
        <li><a href="/category/edit">Add a new Category</a></li>
        <li><a href="/author/logout">Logout</a></li>
      <?php } ?>
      
    </ul>
  </nav>

  <main>
  <?=$output?>
  </main>

  <footer>
  &copy; IJDB 2018
  </footer>
  </body>
</html>