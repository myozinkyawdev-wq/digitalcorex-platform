import { Form, Head } from '@inertiajs/react';
import InputError from '@/components/input-error';
import TextLink from '@/components/text-link';
import { Button } from '@/components/ui/button';
import { Checkbox } from '@/components/ui/checkbox';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import { Spinner } from '@/components/ui/spinner';
import AuthLayout from '@/layouts/auth-layout';
import { register } from '@/routes';
import { store } from '@/routes/login';
import { request } from '@/routes/password';
import { callback as telegramCallback } from '@/routes/telegram';
import React, { useEffect, useMemo, useRef } from 'react';

type Props = {
  status?: string;
  canResetPassword: boolean;
  canRegister: boolean;
};

function TelegramLoginWidget() {
  const tgRef = useRef<HTMLDivElement | null>(null);

  const authUrl = useMemo(() => {
    // Telegram needs an absolute URL
    return new URL(telegramCallback.url(), window.location.origin).toString();
  }, []);

  useEffect(() => {
    if (!tgRef.current) return;

    tgRef.current.innerHTML = '';

    const script = document.createElement('script');
    script.src = 'https://telegram.org/js/telegram-widget.js?22';
    script.async = true;

    // Bot username comes from Vite env
    script.setAttribute('data-telegram-login', import.meta.env.VITE_TELEGRAM_BOT_USERNAME);
    script.setAttribute('data-size', 'large');
    script.setAttribute('data-auth-url', authUrl);

    // optional; remove if you don't need write access
    script.setAttribute('data-request-access', 'write');

    tgRef.current.appendChild(script);
  }, [authUrl]);

  return (
    <div className="mt-6">
      <div className="relative my-4 flex items-center">
        <div className="grow border-t" />
        <span className="mx-3 text-xs text-muted-foreground">OR</span>
        <div className="grow border-t" />
      </div>

      <div className="text-center text-sm text-muted-foreground mb-3">
        Continue with Telegram
      </div>

      {/* Telegram widget renders inside this div */}
      <div className="flex justify-center" ref={tgRef} />
    </div>
  );
}

export default function Login({ status, canResetPassword, canRegister }: Props) {
  return (
    <AuthLayout
      title="Log in to your account"
      description="Enter your email and password below to log in"
    >
      <Head title="Log in" />

      <Form
        {...store.form()}
        resetOnSuccess={['password']}
        className="flex flex-col gap-6"
      >
        {({ processing, errors }) => (
          <>
            <div className="grid gap-6">
              <div className="grid gap-2">
                <Label htmlFor="email">Email address</Label>
                <Input
                  id="email"
                  type="email"
                  name="email"
                  required
                  autoFocus
                  tabIndex={1}
                  autoComplete="email"
                  placeholder="email@example.com"
                />
                <InputError message={errors.email} />
              </div>

              <div className="grid gap-2">
                <div className="flex items-center">
                  <Label htmlFor="password">Password</Label>
                  {canResetPassword && (
                    <TextLink
                      href={request()}
                      className="ml-auto text-sm"
                      tabIndex={5}
                    >
                      Forgot password?
                    </TextLink>
                  )}
                </div>
                <Input
                  id="password"
                  type="password"
                  name="password"
                  required
                  tabIndex={2}
                  autoComplete="current-password"
                  placeholder="Password"
                />
                <InputError message={errors.password} />
              </div>

              <div className="flex items-center space-x-3">
                <Checkbox id="remember" name="remember" tabIndex={3} />
                <Label htmlFor="remember">Remember me</Label>
              </div>

              <Button
                type="submit"
                className="mt-4 w-full"
                tabIndex={4}
                disabled={processing}
                data-test="login-button"
              >
                {processing && <Spinner />}
                Log in
              </Button>
            </div>

            {/* ✅ Telegram Login/Register */}
            <TelegramLoginWidget />

            {canRegister && (
              <div className="text-center text-sm text-muted-foreground">
                Don't have an account?{' '}
                <TextLink href={register()} tabIndex={5}>
                  Sign up
                </TextLink>
              </div>
            )}
          </>
        )}
      </Form>

      {status && (
        <div className="mb-4 text-center text-sm font-medium text-green-600">
          {status}
        </div>
      )}
    </AuthLayout>
  );
}
