<?php

namespace Winata\Core\Indicator\Notify;

use Winata\Core\Indicator\Sessions\SessionStoreInterface;

class NotifyConfig
{
    /**
     * Session storage.
     */
    protected SessionStoreInterface $session;

    /**
     * Configuration options.
     *
     * @var array
     */
    protected array $config;

    /**
     * Setting up the session
     *
     * @param SessionStoreInterface $session
     */
    public function __construct(SessionStoreInterface $session)
    {
        $this->session = $session;
    }

    /**
     * The default configuration for alert
     *
     * @return void
     */
    protected function setDefaultConfig(): void
    {
        $this->config = [
            'type' => 'alert',
            'title' => '',
            'text' => '',
            'duration' => 1000,
        ];
    }

    /**
     * Flash an alert message.
     *
     * @param string $title
     * @param string $text
     * @param bool $isToast
     * @return NotifyConfig
     */
    public function indicator(string $title = '', string $text = '', bool $isToast = false): static
    {
        $mode = 'alert';
        if ($isToast) {
            $mode = 'toast';
        }

        $data = [
            "closeButton" => true,
            "debug" => false,
            "newestOnTop" => true,
            "progressBar" => true,
            "positionClass" => "toastr-top-right",
            "preventDuplicates" => false,
            "onclick" => null,
            "showDuration" => "300",
            "hideDuration" => "1000",
            "timeOut" => "5000",
            "extendedTimeOut" => "1000",
            "showEasing" => "swing",
            "hideEasing" => "linear",
            "showMethod" => "fadeIn",
            "hideMethod" => "fadeOut"
        ];

        $this->config = $data;

        $this->config['mode'] = $mode;
        $this->config['title'] = $title;
        $this->config['text'] = $text;
        $this->config['type'] = 'success';
        $this->flash();
        return $this;
    }

    /**
     * @return $this
     */
    public function success(): static
    {
        $this->config['type'] = 'success';
        $this->flash();
        return $this;
    }

    /**
     * @return $this
     */
    public function info(): static
    {
        $this->config['type'] = 'info';
        $this->flash();
        return $this;
    }

    /**
     * @return $this
     */
    public function warning(): static
    {
        $this->config['type'] = 'warning';
        $this->flash();
        return $this;
    }

    /**
     * @return $this
     */
    public function error(): static
    {
        $this->config['type'] = 'error';
        $this->flash();
        return $this;
    }

    /**
     * @param bool $closeBtn
     * @return $this
     */
    public function closeButton(bool $closeBtn = false): static
    {
        $this->config['closeButton'] = $closeBtn;

        $this->flash();
        return $this;
    }

    /**
     * @param bool $newestOnTop
     * @return $this
     */
    public function newestOnTop(bool $newestOnTop = false): static
    {
        $this->config['newestOnTop'] = $newestOnTop;

        $this->flash();
        return $this;
    }

    /**
     * @param bool $progressBar
     * @return $this
     */
    public function progressBar(bool $progressBar = false): static
    {
        $this->config['progressBar'] = $progressBar;

        $this->flash();
        return $this;
    }

    /**
     * @param int $milliSeconds
     * @return $this
     */
    public function duration(int $milliSeconds = 1000): static
    {
        $this->config['timeOut'] = $milliSeconds;
        $this->flash();
        return $this;
    }

    /**
     * Flash the config options for alert.
     *
     */
    public function flash(): void
    {
        $this->session->flash('notify.config', $this->buildConfig());
    }

    /**
     * Build Flash config options for flashing.
     *
     */
    public function buildConfig(): string
    {
        $config = $this->config;
        return json_encode($config);
    }
}
