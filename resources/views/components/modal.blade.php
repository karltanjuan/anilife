@props(['id' => 'confirmModal'])

<div id="{{ $id }}" class="modal fade" tabindex="-1" aria-labelledby="{{ $id }}Label" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header text-white rounded" style="background: #0C7087;">
                <h5 class="modal-title" id="exampleModalLabel">
                    {{ $title ?? 'N/A' }}
                </h5>
            </div>
            <div class="modal-body">
                {{ $message ?? 'N/A' }}
            </div>
            <div class="modal-footer" style="border-top: 1px solid #0C7087;">
                {{  $slot ?? '' }}
            </div>
        </div>
    </div>
</div>
