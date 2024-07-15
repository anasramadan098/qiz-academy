<footer>
    <div class="col">
        <h2>Simple Courses</h2>
        <ul>
            @foreach (App\Models\ShortCourse::all() as $course)
            <li>
                <a href="/certiication?t=s&id={{$course->id}}">{{$course->name}}</a>
            </li>
            @endforeach
        </ul>
    </div>
    <div class="col">
        <h2>Advanced Courses</h2>
        <ul>
            @foreach (App\Models\LongCourse::all() as $course)
            <li>
                <a href="/certiication?t=l&id={{$course->id}}">{{$course->name}}</a>
            </li>
            @endforeach
        </ul>
    </div>
    <div class="col">
        <h2>Forms</h2>
        <ul>
            @foreach (App\Models\Form::all() as $form)
            <li>
                <a href="/categories">{{$form->name}}</a>
            </li>
            @endforeach
        </ul>
    </div>
    <div class="col">
        <h2>Follow Us</h2>
        <div class="icons">
            <a href="#"><i class="fa-brands fa-facebook-f"></i></a>
            <a href="#"><i class="fa-brands fa-linkedin"></i></a>
            <a href="#"><i class="fa-brands fa-youtube"></i></a>
        </div>
        <p>GAQM, All Rights Reserved.</p>
        <p>Copyright © 2024</p>
    </div>
</footer>