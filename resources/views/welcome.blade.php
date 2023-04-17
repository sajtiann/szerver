<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>GoalZone</title>
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"
    />
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.0.2/css/bootstrap.min.css"
    />
  </head>
  <style>
    body {
    margin: 0;
    padding: 0;
    background-color: #f5f5f5;
    font-family: Arial, sans-serif;
}

img {
    display: block;
    margin: 0 auto;
    border-radius: 8%;
}

.navbar {
    background-color: #00a651;
    height: 80px;
}

.navbar-brand {
    font-size: 2rem;
    font-weight: bold;
    color: #fff;
}

.navbar-nav .nav-link {
    font-size: 1.2rem;
    color: #00a651;
    margin-right: 1rem;
}

.navbar-nav .nav-link:hover {
    color: #fff;
}

.card {
    border-radius: 5px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

.card-body {
    text-align: center;
}

h1 {
    font-size: 2.5em;
    font-weight: bold;
    margin-bottom: 20px;
}

p {
    font-size: 1.2em;
    margin-bottom: 0;
}

@media (min-width: 992px) {
    .navbar-nav {
        display: flex;
        align-items: center;
    }

    .nav-item {
        margin-right: 20px;
    }

    .ms-auto {
        margin-left: auto;
    }
}

.section-heading {
    background-color: #cfcfcf;
    color: rgb(39, 39, 39);
    padding: 10px;
    text-align: center;
    margin: 20px auto;
    border-radius: 5px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    max-width: 800px;
    width: 90%;
}
  </style>
  <body>
    <nav class="navbar navbar-expand-lg navbar-light">
      <div class="container-fluid">
        <a class="navbar-brand" href="#">GoalZone</a>
        <button
          class="navbar-toggler"
          type="button"
          data-bs-toggle="collapse"
          data-bs-target="#navbarNav"
          aria-controls="navbarNav"
          aria-expanded="false"
          aria-label="Toggle navigation"
        >
          <span class="navbar-toggler-icon"></span>
        </button>
        <div
          class="collapse navbar-collapse justify-content-end"
          id="navbarNav"
        >
          <ul class="navbar-nav">
            <li class="nav-item">
              <a class="nav-link" href="{{ route('games.index')}}">Matches</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">Teams</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">Table</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">My Favourites</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>

    <div class="container mt-5">
      <img
        src="https://images.pexels.com/photos/47730/the-ball-stadion-football-the-pitch-47730.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1"
        alt="foci"
        width="340px"
      />
      <h2 class="section-heading">Welcome to Our Website</h2>

      <p class="lead mb-5">
        GoalZone is the ultimate destination for soccer fans who want to stay up-to-date on the latest news, scores, and happenings in the world of soccer. Whether you're a die-hard fan or just getting into the sport, GoalZone has everything you need to know to stay on top of the game.
      </p>

      <div class="row">
        <div class="col-md-4 mb-4">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Matches</h5>
              <p class="card-text">
                Find all the latest match results and schedules here.
              </p>
              <a href="{{ route('games.index')}}" class="btn btn-success">View Matches</a>
            </div>
          </div>
        </div>
        <div class="col-md-4 mb-4">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Teams</h5>
              <p class="card-text">
                Learn more about your favorite teams and their players.
              </p>
              <a href="#" class="btn btn-success">View Teams</a>
            </div>
        </div>
    </div>
    <div class="col-md-4 mb-4">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Table</h5>
                <p class="card-text">
                    Check out the latest league table and standings.
                </p>
                <a href="#" class="btn btn-success">View Table</a>
            </div>
        </div>
    </div>
    </div>

    <div class="row">
    <div class="col-md-6">
        <div class="card mb-4">
            <div class="card-body">
                <h5 class="card-title">My Favorites</h5>
                <p class="card-text">
                    Save your favorite matches and teams for quick access.
                </p>
                <a href="#" class="btn btn-success">View Favorites</a>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card mb-4">
            <div class="card-body">
                <h5 class="card-title">Contact Us</h5>
                <p class="card-text">
                    Get in touch with us for any questions or feedback.
                </p>
                <a href="#" class="btn btn-success">Contact Us</a>
            </div>
        </div>
    </div>
    </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.0.2/js/bootstrap.bundle.min.js"></script>

