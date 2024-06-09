<?php
function returnNav()
{
  return '<nav class="navbar navbar-expand-lg bg-body-tertiary shadow">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">Navbar</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="./">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Features</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Pricing</a>
        </li>
        <li class="nav-item">
          <a class="nav-link disabled" aria-disabled="true">Disabled</a>
        </li>
      </ul>
    </div>
  </div>
</nav>';
}


function returnArticle($row)
{
  $title = htmlEscape($row['title']);
  $createdAt = $row['created_at'];
  $body = htmlEscape($row['body']);
  $postId = $row['id'];

  $articleHTML = '
  
  <article class="card" style="width: 18rem;">
  <div class="card-body">
    <h5 class="card-title">' . $title . '</h5>
    <h6 class="card-subtitle mb-2 text-body-secondary">' . $createdAt . '</h6>
    <p class="card-text">' . $body . '</p>
    <a href="show.php?post_id=' . $postId . '" class="card-link">Read more...</a>
  </div>
  </article>';

  return $articleHTML;
}
