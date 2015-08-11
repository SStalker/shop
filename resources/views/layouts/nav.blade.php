<!--
  Ich habe erst noch ein paar alte Dinge auskommentiert aber nicht gelöscht 
  weil wir sie wahrscheinlich später noch benötigen
-->

<nav class="navbar navbar-default navbar-fixed-top">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <a class="navbar-brand" href="{!! url('/') !!}">Shop</a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Kunde <span class="caret"></span></a>
          <ul class="dropdown-menu">
            @if(Auth::user())
              <li><a href="{!! url('/settings') !!}">Konto</a></li>  
              <li><a href="{!! url('/auth/logout') !!}">Logout</a></li>
              @if(Auth::user()->hasRole('admin'))
                <li><a href="{!! url('/admin/index') !!}">Backend</a></li>
              @endif
            @else
              <li><a href="{!! url('/auth/login') !!}">Login</a></li>
              <li><a href="{!! url('/auth/register') !!}">Registrieren</a></li>
            @endif
            <!--<li role="separator" class="divider"></li>
            <li><a href="{!! url('/users') !!}">Userlist</a></li>
            <li><a href="{!! url('/users/timeline') !!}">Timeline</a></li>
            <li role="separator" class="divider"></li>
            <li><a href="#">One more separated link</a></li>-->
          </ul>
        </li>
        <li><a href="{!! url('/baskets') !!}">Warenkorb</a></li>
        @if(Auth::user())
          @if(Auth::user()->hasRole('admin'))
            <li><a href="{!! url('/permissions') !!}">Rechte</a></li>
            <li><a href="{!! url('/roles') !!}">Rollen</a></li>
            <li><a href="{!! url('/categories') !!}">Kategorien</a></li>
          @endif
        @endif

        @if(Auth::user())
          @if(Auth::user()->hasRole('admin'))
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Produkte <span class="caret"></span></a>
              <ul class="dropdown-menu">
                  <li><a href="{!! url('/products') !!}">Produktübersicht</a></li>
                  <li><a href="{!! url('/products/create') !!}">Neues Produkt</a></li>
              </ul>
            </li>
          @else
            <li><a href="{!! url('/products') !!}">Produkte</a></li>
          @endif
        @else
            <li><a href="{!! url('/products') !!}">Produkte</a></li>
        @endif


      </ul>

        {!! Form::open(['url' => 'search/search', 'method' => 'GET', 'class' => 'input-group navbar-form navbar-right']) !!}
            <div class='form-group input-group-btn'>
                {!! Form::text('searchtext', null, ['class' => 'form-control', 'placeholder' => 'Suche...']) !!}
                {!! Form::button('Suchen', ['type' => 'submit', 'class' => 'btn btn-default ']) !!}
            </div>
        {!! Form::close() !!}



        <!--@if(Auth::user())
          <ul class="nav navbar-nav navbar-right">
            <form action="{!! url('/search/search') !!}" method="GET" class="navbar-form navbar-left" role="search">
              <input type="hidden" name="_token" value="{{ csrf_token() }}">
              <div class="form-group">
                <input type="text" name="searchtext" class="form-control" placeholder="Search User">
              </div>
              <button type="submit" class="btn btn-default">Search</button>
            </form>
          </ul>
        @endif -->
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>