@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            @include('common/message')
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md">
                            <h4>{{ __('アカウントが削除されます') }}</h4>
                            <p class="mb-4">アカウントの削除プロセスを開始します。ユーザー名、これまで投稿した商品、公開プロフィールは本サービスに表示されなくなります。</p>
                            <h4>{{ __('その他のヒント') }}</h4>
                            <ul>
                                <li>アカウントを削除しなくてもユーザー名を変更できます。<a href="/setting/account">設定</a>で編集できます。</li>
                                <li>アカウントを削除した場合、これまで投稿した商品も削除されます</li>
                                <li>アカウントを削除した場合、再び復旧することはできません。</li>
                            </ul>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-6 offset-md-4">
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#password-modal">
                                アカウントを削除する
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="password-modal" tabindex="-1" role="dialog" aria-labelledby="password-modal-label">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <form action="/setting/account/confirm_deactivation" name="delete" method="post">
                <input type="hidden" name="_method" value="DELETE">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">{{ __('退会する') }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="閉じる">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>アカウントを削除するために、パスワードを入力してください。</p>
                    <div class="form-group">
                        <label for="password">{{ __('パスワード') }}</label>
                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autofocus> 
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('閉じる') }}</button>
                    <button type="submit" class="btn btn-primary">{{ __('退会する') }}</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection