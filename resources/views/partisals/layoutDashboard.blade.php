{{-- $userData for user details --}}
<div class="container-fluid dashArea">
    <div class="row">
        <div class="col">
            <div class="user_Data d-flex justify-content-start align-items-center">
                <div class="user_DataPhoto">
                    <img src="https://images.unsplash.com/photo-1522075469751-3a6694fb2f61" alt="user_Photo">
                </div>
                <h4 class="user_DataName mt-2">
                    {{ $userData->name }}
                </h4>
            </div>
            <div class="side-Nav">
                <ul class="nav flex-column">
                    <li class="nav-item">
                      <a class="nav-link active" aria-current="page" href="#">Active</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" href="#">Link</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" href="#">Link</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Disabled</a>
                    </li>
                  </ul>
            </div>
        </div>
    </div>
</div>