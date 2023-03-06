<h2>Demo form</h2>
<div action="" method="POST">
    <img src="https://scontent.fhan18-1.fna.fbcdn.net/v/t39.30808-6/329028694_766419998462003_9200322844068044292_n.jpg?stp=dst-jpg_p843x403&_nc_cat=111&ccb=1-7&_nc_sid=730e14&_nc_ohc=2LjGRAj5bOUAX8BVsB_&_nc_ht=scontent.fhan18-1.fna&oh=00_AfCXay1FnMtIG63J_8F3TUrINN0uTFHTvDBMIPVRhGEkgg&oe=6409F41E"
        alt="123">
    <button class="btn btn-primary"><a
            href="{{ route('download') . '?image=' . public_path('storage/Bai 06 - Laravel 8.x - HTTP Response.pdf') }}">Submit</a></button>
    @csrf
</div>
