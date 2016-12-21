Salut {{$name}}

Clique sur le lien pour activer ton compte <a href="{{ URL::to('register/verify/' . hash('ripemd160',$name)) }}">Ici</a>
