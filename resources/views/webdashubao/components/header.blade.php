<header class="header">
<user-info
  getdataurl="{{ route('webajax.member.getuser') }}"
  loginurl="{{ route('web.login.create') }}?redirect_url={{request()->url()}}"
  registerurl="{{ route('web.register.create') }}?redirect_url={{request()->url()}}"
  memberurl="{{ route('member.user.show') }}"
  bookshelfurl="{{ route('member.bookshelf.index') }}"
  inboxurl="{{ route('member.inboxs.index') }}"
  destroyurl="{{ route('web.login.destroy') }}?redirect_url={{request()->url()}}"
  >
</user-info>
</header>
