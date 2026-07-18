@php
    $requestType = $_POST['requestType'] ?? null;

    $isConfirm = $requestType === 'dialog';
    $isError = isset($response_Type_Fails) || $requestType === 'Failed';
    $isUpdated = isset($response_Type_Updated) || $requestType === 'Update';
    $isCreated = isset($response_Type_Created) || $requestType === 'New';
    $shouldRender = $isConfirm || $isError || $isUpdated || $isCreated;

    if ($shouldRender) {
        if ($isConfirm) {
            $modalId = 'ask_Modal';
            $variant = 'confirm';
            $title = 'Confirm changes';
            $bodyMessage = 'Are you sure you want to proceed with these changes?';
        } elseif ($isError) {
            $modalId = 'Failed';
            $variant = 'error';
            $title = 'Request failed';
            $bodyMessage = $message ?? 'Something went wrong. Please try again.';
        } elseif ($isUpdated) {
            $modalId = 'success';
            $variant = 'success';
            $title = 'Post updated';
            $bodyMessage = $message ?? 'Your changes have been saved successfully.';
        } else {
            $modalId = 'success';
            $variant = 'success';
            $title = 'Post published';
            $bodyMessage = $message ?? 'Your story is live and ready for readers.';
        }

        $icon = match ($variant) {
            'error' => 'bx-error-circle',
            'confirm' => 'bx-help-circle',
            default => 'bx-check-circle',
        };
    }
@endphp

@if ($shouldRender ?? false)
<div class="tts-toast-overlay alert_Overlay_Container" id="{{ $modalId }}" role="dialog" aria-modal="true" aria-labelledby="{{ $modalId }}-title">
    <div class="tts-toast-card alert_Overlay">
        <button type="button" class="tts-toast-close" data-dismiss-toast aria-label="Close">
            <i class='bx bx-x'></i>
        </button>

        <div class="tts-toast-icon tts-toast-icon--{{ $variant }}" aria-hidden="true">
            <i class='bx {{ $icon }}'></i>
        </div>

        <div class="tts-toast-body">
            <p class="tts-toast-kicker">{{ $variant === 'confirm' ? 'Confirmation' : ($variant === 'error' ? 'Error' : 'Success') }}</p>
            <h3 class="tts-toast-title" id="{{ $modalId }}-title">{{ $title }}</h3>
            <p class="tts-toast-message">{{ $bodyMessage }}</p>
        </div>

        @if ($isConfirm)
        <div class="tts-toast-actions">
            <button type="button" class="tts-toast-btn tts-toast-btn--ghost responseButton" id="response_False" data-id="false" value="false">Cancel</button>
            <button type="button" class="tts-toast-btn tts-toast-btn--primary responseButton" id="response_True" data-id="true" value="true">Yes, continue</button>
        </div>
        @else
        <div class="tts-toast-progress" aria-hidden="true"></div>
        @endif
    </div>
</div>
@endif
