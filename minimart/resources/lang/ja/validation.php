<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | as the size rules. Feel free to tweak each of these messages here.
    |
    */

    'accepted'             => ':attributeを承認してください。',
    'active_url'           => ':attributeが有効なURLではありません。',
    'after'                => ':attributeには、:dateより後の日付を入力してください。',
    'after_or_equal'       => ':attributeには、:date以前の日付を入力してください。',
    'alpha'                => ':attributeはアルファベットのみがご利用できます。',
    'alpha_dash'           => ':attributeはアルファベットとダッシュ(-)及び下線(_)がご利用できます。',
    'alpha_num'            => ':attributeはアルファベット数字がご利用できます。',
    'array'                => ':attributeは配列でなくてはなりません。',
    'before'               => ':attributeには、:dateより前の日付をご利用ください。',
    'before_or_equal'      => ':attributeには、:date以前の日付をご利用ください。',
    'between'              => [
        'numeric' => ':attributeは、:minから:maxの間で入力してください。',
        'file'    => ':attributeは、:min kBから、:max kBの間で入力してください。',
        'string'  => ':attributeは、:min文字から、:max文字の間で入力してください。',
        'array'   => ':attributeは、:min個から:max個の間で入力してください。',
    ],
    'boolean'              => ':attributeは、trueかfalseを入力してください。',
    'confirmed'            => ':attributeと、確認フィールドとが、一致していません。',
    'date'                 => ':attributeには有効な日付を入力してください。',
    'date_format'          => ':attributeは:format形式で入力してください。',
    'different'            => ':attributeと:otherには、異なった内容を入力してください。',
    'digits'               => ':attributeは:digits桁で入力してください。',
    'digits_between'       => ':attributeは:min桁から:max桁の間で入力してください。',
    'dimensions'           => ':attributeの図形サイズが正しくありません。',
    'distinct'             => ':attributeには異なった値を入力してください。',
    'email'                => ':attributeには、有効なメールアドレスを入力してください。',
    'exists'               => '選択された:attributeは正しくありません。',
    'file'                 => ':attributeにはファイルを入力してください。',
    'filled'               => ':attributeに値を入力してください。',
    'gt'                   => [
        'numeric' => ':attributeには、:valueより大きな値を入力してください。',
        'file'    => ':attributeには、:value kBより大きなファイルを入力してください。',
        'string'  => ':attributeは、:value文字より長く入力してください。',
        'array'   => ':attributeには、:value個より多くのアイテムを入力してください。',
    ],
    'gte'                  => [
        'numeric' => ':attributeには、:value以上の値を入力してください。',
        'file'    => ':attributeには、:value kB以上のファイルを入力してください。',
        'string'  => ':attributeは、:value文字以上で入力してください。',
        'array'   => ':attributeには、:value個以上のアイテムを入力してください。',
    ],
    'image'                => ':attributeには画像ファイルを入力してください。',
    'in'                   => '選択された:attributeは正しくありません。',
    'in_array'             => ':attributeには:otherの値を入力してください。',
    'integer'              => ':attributeは整数で入力してください。',
    'ip'                   => ':attributeには、有効なIPアドレスを入力してください。',
    'ipv4'                 => ':attributeには、有効なIPv4アドレスを入力してください。',
    'ipv6'                 => ':attributeには、有効なIPv6アドレスを入力してください。',
    'json'                 => ':attributeには、有効なJSON文字列を入力してください。',
    'lt'                   => [
        'numeric' => ':attributeには、:valueより小さな値を入力してください。',
        'file'    => ':attributeには、:value kBより小さなファイルを入力してください。',
        'string'  => ':attributeは、:value文字より短く入力してください。',
        'array'   => ':attributeには、:value個より少ないアイテムを入力してください。',
    ],
    'lte'                  => [
        'numeric' => ':attributeには、:value以下の値を入力してください。',
        'file'    => ':attributeには、:value kB以下のファイルを入力してください。',
        'string'  => ':attributeは、:value文字以下で入力してください。',
        'array'   => ':attributeには、:value個以下のアイテムを入力してください。',
    ],
    'max'                  => [
        'numeric' => ':attributeには、:max以下の数字を入力してください。',
        'file'    => ':attributeには、:max kB以下のファイルを入力してください。',
        'string'  => ':attributeは、:max文字以下で入力してください。',
        'array'   => ':attributeは:max個以下入力してください。',
    ],
    'mimes'                => ':attributeには:valuesタイプのファイルを入力してください。',
    'mimetypes'            => ':attributeには:valuesタイプのファイルを入力してください。',
    'min'                  => [
        'numeric' => ':attributeには、:min以上の数字を入力してください。',
        'file'    => ':attributeには、:min kB以上のファイルを入力してください。',
        'string'  => ':attributeは、:min文字以上で入力してください。',
        'array'   => ':attributeは:min個以上入力してください。',
    ],
    'not_in'               => '選択された:attributeは正しくありません。',
    'not_regex'            => ':attributeの形式が正しくありません。',
    'numeric'              => ':attributeには、数字を入力してください。',
    'present'              => ':attributeが存在していません。',
    'regex'                => ':attributeに正しい形式を入力してください。',
    'required'             => ':attributeは必ず入力してください。',
    'required_if'          => ':otherが:valueの場合、:attributeも入力してください。',
    'required_unless'      => ':otherが:valuesでない場合、:attributeを入力してください。',
    'required_with'        => ':valuesを入力する場合は、:attributeも入力してください。',
    'required_with_all'    => ':valuesを入力する場合は、:attributeも入力してください。',
    'required_without'     => ':valuesを入力しない場合は、:attributeを入力してください。',
    'required_without_all' => ':valuesのどれも入力しない場合は、:attributeを入力してください。',
    'same'                 => ':attributeと:otherには同じ値を入力してください。',
    'size'                 => [
        'numeric' => ':attributeは:sizeを入力してください。',
        'file'    => ':attributeのファイルは、:sizeキロバイトでなくてはなりません。',
        'string'  => ':attributeは:size文字で入力してください。',
        'array'   => ':attributeは:size個入力してください。',
    ],
    'string'               => ':attributeは文字列を入力してください。',
    'timezone'             => ':attributeには、有効なゾーンを入力してください。',
    'unique'               => ':attributeの値は既に存在しています。',
    'uploaded'             => ':attributeのアップロードに失敗しました。',
    'url'                  => ':attributeに正しい形式を入力してください。',
    'uuid' => ':attributeには、有効なUUIDを入力してください。',

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Here you may specify custom validation messages for attributes using the
    | convention "attribute.rule" to name the lines. This makes it quick to
    | specify a specific custom language line for a given attribute rule.
    |
    */

    'custom' => [
        '属性名' => [
            'ルール名' => 'カスタムメッセージ',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap our attribute placeholder
    | with something more reader friendly such as "E-Mail Address" instead
    | of "email". This simply helps us make our message more expressive.
    |
    */

    'attributes' => [
        'user_id' => 'ユーザーID',
        'user name' => 'ユーザー名',
        'email' => 'メールアドレス',
        'password' => 'パスワード',
    ],

];
