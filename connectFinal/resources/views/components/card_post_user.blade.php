
<style>
:root {
  --clr-gray-light: #d7dfe2;
  --clr-gray-med: #616b74;
  --clr-gray-dark: #414b56;
  --clr-link: #4d97b2;
  --clr-popular: #ef257a;
  --clr-technology: #651fff;
  --clr-psychology: #e85808;
}

.cards {
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

/* .banner-img {
  position: absolute;
  object-fit: cover;
  height: 14rem;
  width: 100%;
} */

.banner-img {
      position: absolute;
      object-fit: cover;
      height: 14rem;
      width: 100%;
      top: 0;
        left: 0;
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
  color: rgb(80, 0, 42);
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

</style>


<div class="container">
    <div class="row border-bottom pb-3 mb-3">
        @if($postNoticias->isEmpty())
            <p style="color: black">Não há nada para mostrar.</p>
        @else
            @foreach ($postNoticias as $post)
            <div class="cards">
                <div class="card-banner">
                    <p class="category-tag popular">{{ $post->titulo}}</p>
                    <img class="banner-img" src="{{$post->foto ? asset('storage/' . $post->foto) : asset('images/post-default.png') }}" alt='{{ $post->titulo}}'>
                </div>
                <div class="card-body">

                    @foreach ($categoria as $category)
                        <option value="{{ $category->id }}" class="blog-hashtag">{{ $category->nome }}</option>
                    @endforeach

                    @foreach ($linguages as $linguagem)
                        <option value="{{ $linguagem->id }}" class="blog-hashtag">{{ $linguagem->name }}</option>
                    @endforeach

                    <p class="blog-description">{{ $post->descricao }}</p>
                </div>
            </div>
            @endforeach
        @endif
    </div>
</div>
</div>

{{-- <style>
:root {
  --clr-gray-light: #d7dfe2;
  --clr-gray-med: #616b74;
  --clr-gray-dark: #414b56;
  --clr-link: #4d97b2;
  --clr-popular: #ef257a;
  --clr-technology: #651fff;
  --clr-psychology: #e85808;
}

.cards {
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
  color: rgb(80, 0, 42);
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

</style>
    <div class="cards">
        <div class="card-banner">
            <p class="category-tag popular">Front end development?</p>
            <img class="banner-img" src='https://images.unsplash.com/photo-1515879218367-8466d910aaa4?ixlib=rb-1.2.1&q=80&fm=jpg&crop=entropy&cs=tinysrgb&w=400&fit=max&ixid=eyJhcHBfaWQiOjE0NTg5fQ' alt=''>
        </div>
        <div class="card-body">
            <p class="blog-hashtag">#laravel</p>

            <p class="blog-description">My thoughts on the future of front end web development</p>

            <div class="card-profile">
                    <div style="display: flex; align-items: center;">
                        <img class="profile-img"
                        src="{{$users->photo ? asset('storage/' . $users->photo) : asset('images/default-profile.png') }}"
                        style="display: inline-block; vertical-align: middle; margin-right: 10px;">
                        <div style="display: flex; flex-direction: column;">
                            <p class='nameUserModal' style="margin: 0;">{{$users->name}}</p>
                            <p class='jobUser ' style="margin: 0;">{{$users->formacao}}</p>
                        {{-- </div> --}}
                </div>
            </div>
        </div>
    </div>
 --}}
