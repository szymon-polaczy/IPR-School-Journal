<section>
        <h2>All Rooms</h2>
        <ul>
            @foreach($rooms as $room)
                <li style="display: flex; gap: 20px;">
                    <a href="">
                        See {{$room->name}}
                    </a>

                    @can('edit-rooms')
                    -
                    <form class="block w-full" action="/edit-room/{{$room->id}}" method="POST">
                        @csrf
                        @method('PUT')

                        <input type="text" name="name"
                            placeholder="room name"
                            value="{{$room->name}}"
                            class="simple-input"
                        />

                        <button class="std-btn">Update</button>
                    </form>
                    @endcan

                    @can('delete-rooms')
                    -
                    <form class="block w-full" action="/delete-room/{{$room->id}}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button class="std-btn">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" class="w-4 h-4 fill-white">
                                <path d="M135.2 17.7L128 32H32C14.3 32 0 46.3 0 64S14.3 96 32 96H416c17.7 0 32-14.3 32-32s-14.3-32-32-32H320l-7.2-14.3C307.4 6.8 296.3 0 284.2 0H163.8c-12.1 0-23.2 6.8-28.6 17.7zM416 128H32L53.2 467c1.6 25.3 22.6 45 47.9 45H346.9c25.3 0 46.3-19.7 47.9-45L416 128z"/>
                            </svg>
                        </button>
                    </form>
                    @endcan
                </li>
            @endforeach
        </ul>
    </section>

    @can('create-rooms')
    <section style="margin-top: 50px;">
        <h2>Create a New Room</h2>
        <form class="block w-full" action="/create-room" method="POST">
            @csrf

            <input type="text" name="name"
                placeholder="room name"
                class="simple-input"
            />

            <button class="std-btn">Save room</button>
        </form>
    </section>
    @endcan
