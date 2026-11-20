@php
    $isEdit = $tour->exists;
    $title = $isEdit ? 'Sửa tour' : 'Thêm tour';
    $tabs = ['general' => 'Thông tin chung', 'photos' => 'Ảnh tour', 'schedule' => 'Lịch trình'];
    $errorField = explode('.', $errors->keys()[0] ?? '')[0];
    $activeTab = match ($errorField) {
        'tour_images' => 'photos',
        'timeline' => 'schedule',
        default => 'general',
    };
    $fields = [
        ['title', 'Tên tour', 'text'], ['destination', 'Điểm đến', 'text'],
        ['domain', 'Khu vực', 'select'], ['startDate', 'Khởi hành', 'date'],
        ['endDate', 'Kết thúc', 'date'], ['time', 'Thời lượng', 'text'],
        ['quantity', 'Số chỗ', 'number'], ['priceAdult', 'Giá người lớn (VNĐ)', 'number'],
        ['priceChild', 'Giá trẻ em (VNĐ)', 'number'],
    ];
    $days = old('timeline', $timeline->isEmpty() ? [null] : $timeline->all());
    $cover = $images->isNotEmpty() ? asset('clients/assets/images/image-tour/' . $images->first()) : '';
    $previewPrice = old('priceAdult', $tour->priceAdult);
@endphp

@include('admin.block.header', ['title' => $title])

<main class="container-fluid tour-editor px-3 px-lg-4 py-3 py-md-4">
    <nav class="small mb-2" aria-label="Đường dẫn">
        <a class="admin-tour-link" href="{{ route('admin.tours.index') }}">Danh sách tour</a>
        <span aria-hidden="true" class="mx-1">/</span>
        <span aria-current="page">{{ $title }}</span>
    </nav>

    <form id="tour-form" method="POST" enctype="multipart/form-data" data-active-tab="{{ $activeTab }}"
        action="{{ $isEdit ? route('admin.tours.update', ['tourid' => $tour->tourid]) : route('admin.tours.store') }}">
        @csrf
        @if ($isEdit)
            @method('PATCH')
        @endif

        <div class="d-flex align-items-center justify-content-between gap-2 mb-3">
            <h1 class="h3 fw-bold mb-0">{{ $title }}</h1>
            <button type="submit" class="btn btn-success">{{ $isEdit ? 'Lưu thay đổi' : 'Lưu tour' }}</button>
        </div>

        <div class="tour-tabs mb-3" role="tablist" aria-label="Nội dung tour" hidden>
            @foreach ($tabs as $key => $label)
                <button type="button" role="tab" id="tab-{{ $key }}" aria-controls="panel-{{ $key }}"
                    aria-selected="{{ $activeTab === $key ? 'true' : 'false' }}">{{ $label }}</button>
            @endforeach
        </div>

        <div class="tour-editor-layout">
            <div class="tour-panels">
                <section id="panel-general" class="card card-body p-3 p-lg-4" role="tabpanel" aria-labelledby="tab-general">
                    <h2 class="h5 fw-bold mb-3">Thông tin tour</h2>
                    <div class="row gx-3 gy-2">
                        @foreach ($fields as [$name, $label, $type])
                            <div class="{{ $name === 'title' ? 'col-12' : 'col-12 col-sm-6' }}">
                                <label for="{{ $name }}" class="form-label">{{ $label }}</label>
                                @if ($name === 'domain')
                                    <select id="domain" name="domain" class="form-select" required>
                                        <option value="">Chọn khu vực</option>
                                        @foreach (['b' => 'Miền Bắc', 't' => 'Miền Trung', 'n' => 'Miền Nam'] as $code => $region)
                                            <option value="{{ $code }}" @selected(old('domain', $tour->domain) === $code)>{{ $region }}</option>
                                        @endforeach
                                    </select>
                                @else
                                    <input id="{{ $name }}" name="{{ $name }}" type="{{ $type }}" class="form-control"
                                        @if ($name === 'time') list="tour-durations" @endif
                                        value="{{ old($name, $tour->$name) }}" required>
                                @endif
                                @error($name)
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        @endforeach
                        <datalist id="tour-durations">
                            <option value="1 ngày 1 đêm"></option>
                            <option value="3 Ngày 2 Đêm"></option>
                            <option value="4 ngày 3 đêm"></option>
                            <option value="5 ngày 4 đêm"></option>
                        </datalist>
                        <div class="col-12">
                            <label for="description" class="form-label">Mô tả tour</label>
                            <textarea id="description" name="description" class="form-control" rows="2" required>{{ old('description', $tour->description) }}</textarea>
                            @error('description')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                </section>

                <section id="panel-photos" class="card card-body p-3 p-lg-4" role="tabpanel" aria-labelledby="tab-photos">
                    <h2 class="h5 fw-bold mb-3">Ảnh tour</h2>
                    <label for="tour-images" class="form-label">Chọn bộ ảnh</label>
                    <input id="tour-images" name="tour_images[]" type="file" multiple accept="image/jpeg,image/png,image/webp"
                        class="form-control" aria-describedby="tour-images-help">
                    <div id="tour-images-help" class="form-text mb-3">
                        Chọn tối đa 5 ảnh JPG, PNG hoặc WebP, mỗi ảnh tối đa 5 MB. Ảnh đầu tiên làm ảnh bìa.
                        @if ($isEdit && $images->isNotEmpty())
                            Chọn bộ ảnh mới để thay thế bộ ảnh hiện tại khi lưu.
                        @endif
                    </div>
                    @foreach ($errors->get('tour_images') as $message)
                        <small class="text-danger">{{ $message }}</small>
                    @endforeach
                    @foreach ($errors->get('tour_images.*') as $messages)
                        <small class="text-danger">{{ $messages[0] }}</small>
                    @endforeach
                    <div id="tour-thumbnails" class="d-flex flex-wrap gap-2">
                        @foreach ($images as $image)
                            <figure class="m-0">
                                <img class="tour-photo" src="{{ asset('clients/assets/images/image-tour/' . $image) }}" alt="">
                                <figcaption class="small">{{ $loop->first ? 'Ảnh bìa' : 'Ảnh ' . $loop->iteration }}</figcaption>
                            </figure>
                        @endforeach
                    </div>
                </section>

                <section id="panel-schedule" class="card card-body p-3 p-lg-4" role="tabpanel" aria-labelledby="tab-schedule">
                    <div class="d-flex align-items-center justify-content-between mb-3">
                        <h2 class="h5 fw-bold mb-0">Lịch trình theo ngày</h2>
                        <button type="button" id="add-day" class="btn btn-outline-success btn-sm">+ Thêm ngày</button>
                    </div>
                    @if ($errors->has('timeline') || $errors->has('timeline.*'))
                        <p class="text-danger">{{ $errors->first('timeline') ?: $errors->first('timeline.*') }}</p>
                    @endif
                    <div id="timeline-list" class="d-grid gap-2">
                        @foreach ($days as $i => $item)
                            @php($day = (object) $item)
                            <details class="tour-day" @if (($loop->first && empty($day->title)) || $errors->has("timeline.$i.*")) open @endif>
                                <summary><strong>Ngày {{ $i + 1 }}</strong><span class="day-caption">{{ $day->title ?? '' }}</span></summary>
                                @if (!empty($day->timeLineid))
                                    <input type="hidden" name="timeline[{{ $i }}][timeLineid]" value="{{ $day->timeLineid }}">
                                @endif
                                <div class="pt-2">
                                    <label for="day-title-{{ $i }}" class="form-label">Tên chặng</label>
                                    <input id="day-title-{{ $i }}" name="timeline[{{ $i }}][title]" maxlength="255"
                                        class="form-control mb-2" value="{{ $day->title ?? '' }}">
                                    <label for="day-description-{{ $i }}" class="form-label">Nội dung trong ngày</label>
                                    <textarea id="day-description-{{ $i }}" name="timeline[{{ $i }}][description]"
                                        class="form-control" rows="3">{{ $day->description ?? '' }}</textarea>
                                </div>
                            </details>
                        @endforeach
                    </div>
                </section>
            </div>

            <aside class="d-grid gap-3 align-self-start">
                <section class="card card-body p-3 p-lg-4">
                    <h2 class="h5 fw-bold mb-3">Xem trước thẻ tour</h2>
                    <div class="tour-preview">
                        <div class="tour-cover">
                            <span id="empty-cover" @if ($cover) hidden @endif>Chưa có ảnh bìa</span>
                            <img id="preview-cover" @if ($cover) src="{{ $cover }}" @else hidden @endif alt="Ảnh bìa tour">
                        </div>
                        <div class="p-3">
                            <small id="preview-destination" class="text-muted">{{ old('destination', $tour->destination) ?: 'Điểm đến' }}</small>
                            <h3 id="preview-title" class="h5 fw-bold my-2">{{ old('title', $tour->title) ?: 'Tên tour' }}</h3>
                            <div id="preview-time" class="text-muted small mb-2">{{ old('time', $tour->time) ?: 'Thời lượng' }}</div>
                            <strong id="preview-price" class="text-success">{{ is_numeric($previewPrice) ? number_format((float) $previewPrice, 0, ',', '.') . ' đ' : '—' }}</strong><small> / người</small>
                        </div>
                    </div>
                </section>
                <fieldset class="card card-body p-3 p-lg-4">
                    <legend class="h6 fw-bold float-none w-auto mb-2">Vị trí hiển thị</legend>
                    <div class="d-flex flex-wrap gap-2">
                        @foreach (['both' => 'Cả hai trang', 'home' => 'Trang chủ', 'tours' => 'Trang Tours'] as $value => $label)
                            <label class="tour-position">
                                <input type="radio" name="display_position" value="{{ $value }}"
                                    @checked(old('display_position', $tour->display_position ?? 'both') === $value)>
                                {{ $label }}
                            </label>
                        @endforeach
                    </div>
                    @error('display_position')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </fieldset>
            </aside>
        </div>
    </form>
</main>

<script src="{{ asset('admin/js/tour-editor.js') }}" defer></script>
@include('admin.block.footer')
