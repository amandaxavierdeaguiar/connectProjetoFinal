

<div class="wrapper">
    <div class="card">
      <div class="card-banner">
        <p class="category-tag popular">Popular</p>
        <img class="banner-img" src='https://images.unsplash.com/photo-1515879218367-8466d910aaa4?ixlib=rb-1.2.1&q=80&fm=jpg&crop=entropy&cs=tinysrgb&w=400&fit=max&ixid=eyJhcHBfaWQiOjE0NTg5fQ' alt=''>
      </div>
      <div class="card-body">
        <p class="blog-hashtag">#webdevelopment #frontend</p>
        <h2 class="blog-title">What is the future of front end development?</h2>
        <p class="blog-description">My thoughts on the future of front end web development</p>

        <div class="card-profile">
          <img class="profile-img" src='https://images.unsplash.com/photo-1554780336-390462301acf?ixlib=rb-1.2.1&q=80&fm=jpg&crop=entropy&cs=tinysrgb&w=400&fit=max&ixid=eyJhcHBfaWQiOjE0NTg5fQ' alt=''>
          <div class="card-profile-info">
            <h3 class="profile-name">Maya Eleanor Peña</h3>
            <p class="profile-followers">1.2k followers</p>
          </div>
        </div>
      </div>
    </div>

    <div class="card">
      <div class="card-banner">
        <p class="category-tag technology">Technology</p>
        <img class="banner-img" src='https://images.unsplash.com/photo-1413708617479-50918bc877eb?ixlib=rb-1.2.1&q=80&fm=jpg&crop=entropy&cs=tinysrgb&w=400&fit=max&ixid=eyJhcHBfaWQiOjE0NTg5fQ' alt=''>
      </div>
      <div class="card-body">
        <p class="blog-hashtag">#photographer #gearupgrade #selfmade</p>
        <h2 class="blog-title">Photography gear you need this year</h2>
        <p class="blog-description">Looking to upgrade your gear? Here is the list of the best photography tools for this year</p>

        <div class="card-profile">
          <img class="profile-img" src='https://images.unsplash.com/photo-1532332248682-206cc786359f?ixlib=rb-1.2.1&q=80&fm=jpg&crop=entropy&cs=tinysrgb&w=400&fit=max&ixid=eyJhcHBfaWQiOjE0NTg5fQ' alt=''>
          <div class="card-profile-info">
            <h3 class="profile-name">Darrell Steward</h3>
            <p class="profile-followers">45.7k followers</p>
          </div>
        </div>
      </div>
    </div>

    <div class="card">
      <div class="card-banner">
        <p class="category-tag psychology">Psychology</p>
        <img class="banner-img" src='https://images.unsplash.com/photo-1592496001020-d31bd830651f?ixlib=rb-1.2.1&q=80&fm=jpg&crop=entropy&cs=tinysrgb&w=400&fit=max&ixid=eyJhcHBfaWQiOjE0NTg5fQ' alt=''>
      </div>
      <div class="card-body">
        <p class="blog-hashtag">#mediation #mentalwellness</p>
        <h2 class="blog-title">Mediation and Mental Wellness Best Practices</h2>
        <p class="blog-description">Mediation has transformed my life. These are the best practices to get into the habit</p>

        <div class="card-profile">
          <img class="profile-img" src='https://images.unsplash.com/photo-1569913486515-b74bf7751574?ixlib=rb-1.2.1&q=80&fm=jpg&crop=entropy&cs=tinysrgb&w=400&fit=max&ixid=eyJhcHBfaWQiOjE0NTg5fQ' alt=''>
          <div class="card-profile-info">
            <h3 class="profile-name">Savannah Nguyen</h3>
            <p class="profile-followers">318 followers</p>
          </div>
        </div>
      </div>
    </div>

  </div>
  :root {
    --clr-gray-light: #d7dfe2;
    --clr-gray-med: #616b74;
    --clr-gray-dark: #414b56;
    --clr-link: #4d97b2;
    --clr-popular: #ef257a;
    --clr-technology: #651fff;
    --clr-psychology: #e85808;
  }

  * {
    box-sizing: border-box;
    font-family: "Inter", sans-serif;
    margin: 0;
    padding: 0;
  }

  body {
    margin: 2rem;
    color: var(--clr-gray-dark);
  }

  .wrapper {
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
  }

  .card {
    overflow: hidden;
    box-shadow: 0px 2px 20px var(--clr-gray-light);
    background: white;
    border-radius: 0.5rem;
    position: relative;
    width: 350px;
    margin: 1rem;
    transition: 250ms all ease-in-out;
    cursor: pointer;
  }

  .card:hover {
    transform: scale(1.05);
    box-shadow: 0px 2px 40px var(--clr-gray-light);
  }

  .banner-img {
    position: absolute;
    object-fit: cover;
    height: 14rem;
    width: 100%;
  }

  .category-tag {
    font-size: 0.8rem;
    font-weight: bold;
    color: white;
    background: red;
    padding: 0.5rem 1.3rem 0.5rem 1rem;
    text-transform: uppercase;
    position: absolute;
    z-index: 1;
    top: 1rem;
    border-radius: 0 2rem 2rem 0;
  }

  .popular {
    background: var(--clr-popular);
  }

  .technology {
    background: var(--clr-technology);
  }

  .psychology {
    background: var(--clr-psychology);
  }

  .card-body {
    margin: 15rem 1rem 1rem 1rem;
  }

  .blog-hashtag {
    font-size: 0.9rem;
    font-weight: 500;
    color: var(--clr-link);
  }

  .blog-title {
    line-height: 1.5rem;
    margin: 1rem 0 0.5rem;
  }

  .blog-description {
    color: var(--clr-gray-med);
    font-size: 0.9rem;
  }

  .card-profile {
    display: flex;
    margin-top: 2rem;
    align-items: center;
  }

  .profile-img {
    width: 60px;
    height: 60px;
    object-fit: cover;
    border-radius: 50%;
  }

  .card-profile-info {
    margin-left: 1rem;
  }

  .profile-name {
    font-size: 1rem;
  }

  .profile-followers {
    color: var(--clr-gray-med);
    font-size: 0.9rem;
  }
