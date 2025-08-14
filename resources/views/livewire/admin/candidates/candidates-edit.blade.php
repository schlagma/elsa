<div class="flex flex-col p-6 sm:p-8 overflow-y-auto h-full">
    <div class="xl:flex xl:items-center">
        <div class="sm:flex-auto">
            <h1 class="text-2xl font-bold leading-6 text-zinc-800 dark:text-white">{{ __('admin.candidatesEditTitle') }}</h1>
        </div>
    </div>
    <div class="mt-6 mb-12">
        <div class="grid sm:grid-cols-2 xl:grid-cols-3 gap-6">
            <div>
                <label>{{ __('admin.firstname') }}</label>
                <input type="text" wire:model="firstname" class="w-full">
            </div>
            <div>
                <label>{{ __('admin.lastname') }}</label>
                <input type="text" wire:model="lastname" class="w-full">
            </div>
            <div>
                <label>{{ __('admin.emailAddress') }}</label>
                <input type="text" wire:model="email" class="w-full">
            </div>
            <div>
            <label>{{ __('admin.faculty') }}</label>
                <select wire:model="faculty">
                    @foreach ($faculties as $faculty)
                    <option value="{{ $faculty->id }}">{{ json_decode($faculty->name)[0] }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label>{{ __('admin.course') }}</label>
                <select wire:model="course">
                    @foreach ($courses as $course)
                    <option value="{{ $course->id }}">{{ json_decode($course->name)[0] }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="mt-6 grid sm:grid-cols-2 xl:grid-cols-3 gap-6">
            <div>
                <label>{{ __('admin.election') }}</label>
                <select wire:model.change="election">
                    @foreach ($elections as $election)
                    <option value="{{ $election->id }}">{{ json_decode($election->name)[0] }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label>{{ __('admin.committee') }}</label>
                <select wire:model.change="committee">
                    @foreach ($committees as $committee)
                    <option value="{{ $committee->id }}">{{ json_decode($committee->name)[0] }}</option>
                    @endforeach
                </select>
            </div>
            @if (count($lists) > 0)
            <div>
                <label>{{ __('admin.list') }}</label>
                <select wire:model="list">
                    <option>{{ __('common.selectAnOption') }}</option>
                    @foreach ($lists as $list)
                    <option value="{{ $list->id }}">{{ json_decode($list->name)[0] }}</option>
                    @endforeach
                </select>
            </div>
            @endif
        </div>
        <div class="mt-6 grid md:grid-cols-2 gap-6">
            <label class="-mb-4 md:hidden">{{ __('admin.answers') }}</label>
            <label class="-mb-4 hidden md:inline">{{ __('admin.answersDE') }}</label>
            <label class="-mb-4 hidden md:inline">{{ __('admin.answersEN') }}</label>
            @foreach ($questions[0] as $index => $question)
            <div>
                <div class="card-header">{{ $questions[0][$index] }}</div>
                <textarea wire:model="answersDE.{{ $index }}" class="h-[6rem] !rounded-t-none"></textarea>
            </div>
            <div>
                <div class="card-header">{{ $questions[1][$index] }}</div>
                <textarea wire:model="answersEN.{{ $index }}" class="h-[6rem] !rounded-t-none"></textarea>
            </div>
            @endforeach
        </div>
        <div class="mt-6 grid sm:grid-cols-2 gap-6">
            <div>
                <label>{{ __('admin.candidacyReceived') }}</label>
                <input type="datetime-local" wire:model="candidacyReceived">
            </div>
            <div>
                <label>{{ __('admin.approved') }}</label>
                <input type="checkbox" wire:model="approved">
            </div>
            <div>
                <label>{{ __('admin.votes') }}</label>
                <input type="number" wire:model="votes">
            </div>
            <div>
                <label>{{ __('admin.resigned') }}</label>
                <input type="checkbox" wire:model="resigned">
            </div>
        </div>
        <div class="mt-6 flex items-center justify-end gap-x-4">
            <a wire:navigate href="{{ url()->previous() }}" class="btn-neutral">
                <span aria-hidden="true">@svg('mdi-cancel', '-ml-0.5 size-5')</span>
                {{ __('common.cancel') }}
            </a>
            <button wire:click="save" class="btn-primary">
                <span aria-hidden="true">@svg('mdi-content-save', '-ml-0.5 size-5')</span>
                {{ __('common.save') }}
            </button>
        </div>
    </div>
    <div x-data="cropper">
        @if ($pictureUrl)
        <img src="{{ $pictureUrl }}" class="max-h-[15rem] rounded-md shadow">
        <div class="flex gap-x-4 mt-6">
            <button type="button" class="btn-primary ml-auto" @click="removeImage">
                <span aria-hidden="true">@svg('mdi-delete', '-ml-0.5 size-5')</span>
                {{ __('admin.delete') }}
            </button>
        </div>
        @else
        <div>
            <input
                id="imageInput"
                type="file"
                accept="image/*"
                class="w-full h-[15rem] px-3 py-2 border border-zinc-200 rounded-md cursor-pointer"
                :value="imageCropped"
                x-show="!imageIsSelected"
                x-on:change="loadImage"
            >
            <img id="image" class="max-w-full h-[15rem]" x-show="imageIsSelected">
        </div>
        <div class="flex gap-x-4 mt-6">
            <button type="button" class="btn-neutral ml-auto" @click="cancelImage">
                <span aria-hidden="true">@svg('mdi-cancel', '-ml-0.5 size-5')</span>
                {{ __('common.cancel') }}
            </button>
            <button type="button" class="btn-primary" @click="cropImage">
                <span aria-hidden="true">@svg('mdi-crop', '-ml-0.5 size-5')</span>
                {{ __('admin.crop') }}
            </button>
        </div>
        @endif
    </div>
</div>

@script
<script>
Alpine.data('cropper', () => {
    return {
        img: null,
        imgInput: null,
        file: null,
        imageFile: null,
        imageCropped: null,
        imageIsSelected: false,
        cropper: null,
        loadImage() {
            this.img = document.getElementById('image');
            if (this.cropper != null) {
                this.cropper.destroy();
            }

            this.cropper = new Cropper(this.img, {
                zoomable: false,
            });

            this.file = event.target.files[0]

            if (this.file.type.indexOf('image/') === -1) {
                alert('Bitte wähle eine Bild-Datei aus. / Please select an image file.')
                return
            }

            if (typeof FileReader === 'function') {
                const reader = new FileReader()

                reader.onload = (event) => {
                    this.imageFile = event.target?.result
                    this.cropper.replace(event.target?.result)
                };

                reader.readAsDataURL(this.file);
                this.imageIsSelected = true;
            } else {
                alert('Dein Browser scheint die FileReader-API nicht zu unterstützen. / Your browser does not seem to support the FileReader API.')
            }
        },
        cropImage() {
            $wire.imageCropped = this.cropper.getCroppedCanvas().toDataURL('image/jpeg')
            $wire.saveImage()
        },
        removeImage() {
            $wire.removeImage()
            this.file = null
            this.imageFile = null
            this.imageCropped = null
            if (this.cropper != null) {
                this.cropper.destroy()
            }
            this.imageIsSelected = false
        },
        cancelImage() {
            this.file = null
            this.imageFile = null
            this.imageCropped = null
            if (this.cropper != null) {
                this.cropper.destroy()
            }
            this.imageIsSelected = false
        }
    }
})
</script>
@endscript