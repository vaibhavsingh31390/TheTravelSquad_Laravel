<?php
if (isset($_POST['requestType'])) {
    switch ($_POST['requestType']) {
        case 'New':
        case 'Update':
?><div class="container-fluid d-flex justify-content-center align-items-center alert_Overlay_Container" id="success">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 p-0 alert_Overlay">
                        <div>
                            <h3 class="d-flex align-items-center p-2 mb-0">
                                <i class='bx bx-info-circle me-2'></i>
                                <span>Information !</span>
                            </h3>
                        </div>
                        <div class="px-2 py-3">
                            <h5 class="p-1 text-center">
                                <span>{{ $message }}</span>
                            </h5>
                            <span>
                                <img class="response_Image" src="{{ URL::to('/') }}/assets/success.gif">
                            </span>
                        </div>

                    </div>
                </div>
            </div>
        <?php
            break;

        case 'Failed':
        ?>
            <div class="container-fluid d-flex justify-content-center align-items-center position-fixed alert_Overlay_Container" id="Failed">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 p-0 alert_Overlay">
                        <div>
                            <h3 class="d-flex align-items-center p-2 mb-0">
                                <i class='bx bx-info-circle me-2'></i>
                                <span>Information !</span>
                            </h3>
                        </div>
                        <div class="px-2 py-3">
                            <h5 class="p-1 text-center">
                                <span>{{ $message }}</span>
                            </h5>
                            <span>
                                <img class="response_Image" src="{{ URL::to('/') }}/assets/failed.gif">
                            </span>
                        </div>

                    </div>
                </div>
            </div>
        <?php
            break;
        case: 'dialog'
        ?>
            <div class="container-fluid d-flex justify-content-center align-items-center alert_Overlay_Container" id="ask_Modal">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 p-0 alert_Overlay">
                        <div>
                            <h3 class="d-flex align-items-center p-2 mb-0">
                                <i class='bx bx-info-circle me-2'></i>
                                <span>Information !</span>
                            </h3>
                        </div>
                        <div>
                            <h5 class="d-flex align-items-center p-4">
                                <span>Are you sure you want to proceed with the changes ?</span>
                            </h5>
                        </div>
                        <div class="d-flex justify-content-between align-items-center px-5 py-3 border">
                            <button class="responseButton" id="response_False" data-id="false" value="false">
                                No
                            </button>
                            <button class="responseButton" id="response_True" data-id="true" value="true">
                                Yes
                            </button>
                        </div>
                    </div>
                </div>
    <?php
            break;

            default:
            ?><div class="container-fluid d-flex justify-content-center align-items-center alert_Overlay_Container" id="failed">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 p-0 alert_Overlay">
                        <div>
                            <h3 class="d-flex align-items-center p-2 mb-0">
                                <i class='bx bx-info-circle me-2'></i>
                                <span>Information !</span>
                            </h3>
                        </div>
                        <div class="px-2 py-3">
                            <h5 class="p-1 text-center">
                                <span>Thats All Folks..</span>
                            </h5>
                            <span>
                                <img class="response_Image" src="{{ URL::to('/') }}/assets/failed.gif">
                            </span>
                        </div>

                    </div>
                </div>
            </div>
        <?php
            break;
    }
}
    ?>