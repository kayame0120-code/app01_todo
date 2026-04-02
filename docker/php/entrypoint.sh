#!/bin/bash
set -e

USER_ID=${UID:-1000}
GROUP_ID=${GID:-1000}

# group 作成
if ! getent group appuser >/dev/null; then
    groupadd -g ${GROUP_ID} appuser
fi

# user 作成
if ! id appuser >/dev/null 2>&1; then
    useradd -u ${USER_ID} -g ${GROUP_ID} -m -s /bin/bash appuser
fi

# composer HOME 修正（超重要）
export HOME=/home/appuser
mkdir -p $HOME/.composer
chown -R appuser:appuser $HOME

# Laravelディレクトリ権限
chown -R appuser:appuser /var/www || true

exec gosu appuser "$@"