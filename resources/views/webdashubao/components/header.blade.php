<header class="header">
<user-info
  getdataurl="{{ route('ajax.member.getuser') }}"
  loginurl="{{ route('login.create') }}?redirect_url={{ request()->url() }}"
  registerurl="{{ route('register.create') }}?redirect_url={{ request()->url() }}"
  memberurl="{{ route('member.show') }}"
  bookshelfurl="{{ route('bookshelf.show') }}"
  inboxurl="{{ route('inboxs.index') }}"
  destroyurl="{{ route('login.destroy') }}?redirect_url={{ request()->url() }}"
  >
</user-info>
</header>
