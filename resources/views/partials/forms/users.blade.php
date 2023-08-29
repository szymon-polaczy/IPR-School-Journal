<form action="/create-user" method="POST" id="create-user-form"
    class="fixed top-1/2 left-1/2 transform bg-white p-8 rounded-lg
           -translate-x-1/2 -translate-y-1/2 shadow-2xl shadow-grey-900
           flex align-middle justify-center flex-col gap-4 max-w-sm
           opacity-0 pointer-events-none"
>
    @csrf

    <button id="btn-create-user-popup-close" class="absolute top-4 right-4"
        type="button"
    >
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512"
            class="w-6 h-6"
        >
            <path d="M342.6 150.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L192 210.7 86.6 105.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L146.7 256 41.4 361.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0L192 301.3 297.4 406.6c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L237.3 256 342.6 150.6z"/>
        </svg>
    </button>

    <h2 class="text-2xl text-gray-900 text-center">
       Create user
    </h2>

    <div>
        <select name="user_type" class="simple-input">
            <option>student</option>
            <option>teacher</option>
            <option>admin</option>
        </select>
    </div>


    <div>
        <input type="text" name="name"
            placeholder="Tomek"
            class="simple-input"
        />
    </div>


    <div>
        <input type="text" name="surname"
            placeholder="Nowak"
            class="simple-input"
        />
    </div>


    <div>
        <input type="email" name="email"
            placeholder="email@domain.com"
            class="simple-input"
        />
    </div>


    <div>
        <input type="password" name="password"
            placeholder="very secure password"
            class="simple-input"
        />
    </div>

    <!--teacher-->
    <div>
        <select name="default_room" class="simple-input">
            @foreach($rooms as $room)
                <option value="{{ $room->id }}">
                    {{ $room->name }}
                </option>
            @endforeach
        </select>
    </div>

    <!--student-->
    <div>
        <select name="class" class="simple-input">
            @foreach($classes as $class)
                <option value="{{ $class->id }}">
                    {{ $class->name }}
                </option>
            @endforeach
        </select>
    </div>

    <button type="submit" class="std-btn mt-4"
    >
        Submit
    </button>
</form>
