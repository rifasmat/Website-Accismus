<!-- ======= Sidebar ======= -->
<aside id="sidebar" class="sidebar">

  <ul class="sidebar-nav" id="sidebar-nav">

    <li class="nav-item">
      <a class="nav-link collapsed" href="{{ route('guildleader.dashboard.list') }}">
        <i class="bi bi-grid"></i>
        <span>Dashboard</span>
      </a>
    </li>

    <hr>

    <li class="nav-item">
      <a class="nav-link collapsed" href="{{ route('guildleader.informasi.list') }}">
        <i class="bi bi-info-circle"></i>
        <span>Informasi</span>
      </a>
    </li>

    <li class="nav-item">
      <a class="nav-link collapsed" href="{{ route('guildleader.about.list') }}">
        <i class="bi bi-display"></i>
        <span>About</span>
      </a>
    </li>

    <li class="nav-item">
      <a class="nav-link collapsed" href="{{ route('guildleader.benefit.list') }}">
        <i class="bi bi-box2-heart"></i>
        <span>Benefit</span>
      </a>
    </li>

    <li class="nav-item">
      <a class="nav-link collapsed" href="{{ route('guildleader.history-rf.list') }}">
        <i class="bi bi-aspect-ratio"></i>
        <span>History RF</span>
      </a>
    </li>

    <li class="nav-item">
      <a class="nav-link collapsed" href="{{ route('guildleader.team.list') }}">
        <i class="bi bi-person-workspace"></i>
        <span>Team</span>
      </a>
    </li>

    <li class="nav-item">
      <a class="nav-link collapsed" href="{{ route('guildleader.gallery.list') }}">
        <i class="bi bi-image"></i>
        <span>Gallery</span>
      </a>
    </li>

    <hr>

    <li class="nav-item">
      <a class="nav-link collapsed" data-bs-target="#tables-nav" data-bs-toggle="collapse">
        <i class="bi bi-envelope-paper"></i><span>Broadcast Email</span><i class="bi bi-chevron-down ms-auto"></i>
      </a>
      <ul id="tables-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
        <li>
          <a href="{{ route('guildleader.broadcast.history') }}">
            <i class="bi bi-envelope-open"></i><span>History Email</span>
          </a>
        </li>
        <li>
          <a href="{{ route('guildleader.broadcast.create') }}">
            <i class="bi bi-envelope-arrow-up"></i><span>Send Email</span>
          </a>
        </li>
        <li>
          <a href="{{ route('guildleader.broadcast.email') }}">
            <i class="bi bi-inboxes"></i><span>Daftar Email</span>
          </a>
        </li>
      </ul>
    </li>

    <hr>

    <li class="nav-item">
      <a class="nav-link collapsed" href="{{ route('guildleader.request-member.list') }}">
        <i class="bi bi-person-check"></i>
        <span>Request Member</span>
      </a>
    </li>

    <li class="nav-item">
      <a class="nav-link collapsed" href="{{ route('guildleader.member.list') }}">
        <i class="bi bi-person-vcard"></i>
        <span>Member</span>
      </a>
    </li>

    <li class="nav-item">
      <a class="nav-link collapsed" href="{{ route('guildleader.pengguna.list') }}">
        <i class="bi bi-person-video3"></i>
        <span>Pengguna</span>
      </a>
    </li>

  </ul>

</aside><!-- End Sidebar-->