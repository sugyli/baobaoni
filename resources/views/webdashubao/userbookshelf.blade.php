@extends('webdashubao.layouts.user')
@section('title')用户书架@endsection
@section('keywords')用户书架@endsection
@section('description')用户书架@endsection
@section('substyle')
.case_right li {
    height: 31px;
    color: #666;
    overflow: hidden;
}
.top {
    width: 100%;
    height: 35px;
    line-height: 35px;
    border-bottom: 1px solid #dee1e6;
}
.case_right li.top {
    background: #eff;
    height: 31px;
    font-weight: bold;
    overflow: hidden;
}
.case_right li a:hover{
  color: red;
}

.case_right span {
    float: left;
    line-height: 30px;
    height: 30px;
    color: #333;
    overflow: hidden;
    border-right: #dee1e6 1px solid;
    text-align: center;
    border-bottom: #dee1e6 1px solid;
}
.case_right li .input {
    width: 15px;
    height: 15px;
}
.case_right .fk {
    width: 28px;
}
.case_right .wz {
    width: 145px;
}
.case_right .zx {
    width: 225px;
}
.case_right .gx {
    width: 50px;
}
.case_right .cz {
    width: 50px;
    border-right: medium none;
}

.case_right li.bottom {

    background: #eff;
    height: 38px;
    line-height: 38px;
    font-weight: bold;
}
.case_right .button {
    margin-left: 10px;
    line-height: 25px;
    padding: 0 5px;
    border: #dee1e6 1px solid;
    height: 25px;
    cursor: pointer;
    color: #000;
    background: #e6f5e2;

}
@endsection
@section('usercontent')
<user-bookshelf
      getdataurl="{{ route('webajax.bookshelf.getbookshelfs') }}"
      destroyurl="{{ route('member.bookshelf.destroy') }}"
      redurl={{route('member.bookshelf.clickbookshelf')}}
      token= "{{ csrf_token() }}"
      bookcasecount = "{{ $user->getUserHonor()->getBookcaseCount() }}"
      ></user-bookshelf>
@endsection
