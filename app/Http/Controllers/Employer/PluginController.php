<?php

namespace App\Http\Controllers\Employer;

use App\Helpers\CoreHelper;
use App\Http\Controllers\Controller;
use App\Models\Account;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class PluginController extends Controller
{
    /**
     * @return View
     */
    public function index(): View
    {
        $activePlugins = $this->getActivePlugins();

        return view('employer.plugin.index', compact('activePlugins'));
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function update(Request $request): RedirectResponse
    {
        $accountId = Auth::guard('account')->id();

        $status = $request->input('status');
        $plugin = $request->input('plugin');

        $activePlugins = $this->getActivePlugins();

        if ($status === 'Active') {
            $activePlugins[] = $plugin;
        } else {
            $key = array_search($plugin, $activePlugins);
            if ($key !== false) {
                unset($activePlugins[$key]);
            }
        }

        $currentActivePluginText = implode(',', array_filter($activePlugins));

        try {
            Account::query()
                ->where('id', $accountId)
                ->update([
                    'plugins' => $currentActivePluginText,
                ]);

            if ($status === 'Active') {
                $message = $plugin . ' plugin is active';
            } else {
                $message = $plugin . ' plugin is inactive';
            }

            return redirect()
                ->back()
                ->with('message', CoreHelper::success($message));
        } catch (Exception $exception) {
            return redirect()
                ->back()
                ->with('message', CoreHelper::error($exception->getMessage()));
        }
    }

    /**
     * @return array
     */
    public function getActivePlugins(): array
    {
        $account = Auth::guard('account')->user();
        return explode(',', $account->__get('plugins'));
    }
}
