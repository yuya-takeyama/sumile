<?php
interface Sumile_ServiceProviderInterface
{
    public function register(Sumile_Application $app);

    public function boot(Sumile_Application $app);
}
