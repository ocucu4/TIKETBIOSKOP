<header class="d-flex align-items-center justify-content-between w-100">

    <button id="toggleSidebar" class="btn btn-light me-2 toggle-btn">
        <i id="toggleIcon" class="bi bi-list fs-4"></i>
    </button>

    <h4 class="m-0 fw-semibold"><?= esc($title ?? 'Dashboard') ?></h4>

    <button class="btn btn-light d-flex align-items-center" style="margin-right: 20px;" onclick="openProfilePanel()">
        <img src="<?= base_url('assets/images/user/avatar-1.jpg') ?>" class="rounded-circle me-2" width="34" height="34">
        <span class="fw-semibold">Admin</span>
    </button>

</header>
