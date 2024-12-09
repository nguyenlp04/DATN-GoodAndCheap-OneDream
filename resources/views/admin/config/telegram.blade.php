@extends('layouts.admin')

@section('content')
    <!-- Content wrapper -->
    <div class="content-wrapper">
        <!-- Content -->
        {{-- {{ dd($data['chatID']) }} --}}
        <div class="container-xxl flex-grow-1 container-p-y">
            <div class="app-ecommerce">
                <form action="{{ route('store.telegram') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <!-- Add Notification -->
                    <div
                        class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center mb-6 row-gap-4">
                        <div class="d-flex flex-column justify-content-center">
                            <h4 class="mb-1">Config</h4>
                        </div>
                        {{-- {{ dd($data) }} --}}
                        <div class="d-flex align-content-center flex-wrap gap-4">
                            <div class="d-flex gap-4">
                                {{-- <button type="button" class="btn btn-label-primary"
                                    onclick="window.location='{{ route('notifications.index') }}'">Cancel</button> --}}
                            </div>
                            <button type="submit" class="btn btn-primary" id="btn-send-notification">Submit</button>
                        </div>
                    </div>


                    <div class="nav-align-top">
                        <ul class="nav nav-pills mb-4" role="tablist">
                            <li class="nav-item">
                                <button type="button" class="nav-link active" role="tab" data-bs-toggle="tab"
                                    data-bs-target="#navs-pills-top-home" aria-controls="navs-pills-top-home"
                                    aria-selected="true">Bot Order</button>
                            </li>
                            <li class="nav-item">
                                <button type="button" class="nav-link" role="tab" data-bs-toggle="tab"
                                    data-bs-target="#navs-pills-top-profile" aria-controls="navs-pills-top-profile"
                                    aria-selected="false">Bot Contact</button>
                            </li>

                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane fade show active" id="navs-pills-top-home" role="tabpanel">
                                <div class="row">
                                    <!-- First column-->
                                    <div class="col-12 col-lg-12">
                                        <!-- Notification Information -->
                                        <div class=" mb-6">
                                            {{-- <div class="card-header">
                                                <h5 class="card-title mb-0">Telegram</h5>
                                            </div> --}}
                                            <div class="card-body">
                                                <!-- Description -->
                                                <div class="mb-6">
                                                    <label for="message" class="form-label">Message Template</label>
                                                    <textarea class="form-control" name="message" id="editor" rows="9" placeholder="Message Template">{{ !empty($data['message'])
                                                        ? trim($data['message'])
                                                        : trim(
                                                            "🎉 New Sale Alert! 🎉
                                                                                                                                                                            🆔 Upgrade: {UPGRADE}
                                                                                                                                                                            📦 Name Package: {NAME_PACKAGE}
                                                                                                                                                                            🆔 Channel/Sale News ID: {CHANNEL/SALE_NEWS_ID}
                                                                                                                                                                            🕛 Period: {PERIOD}
                                                                                                                                                                            🤝 Transaction ID: {TRANSACTION_ID}
                                                                                                                                                                            💵 Amount Paid: {AMOUNT}
                                                                                                                                                                            🕛 Payment Date: {PAYMENT_DATE}
                                                                                                                                                                            Congratulations on your sale! 🎉",
                                                        ) }}</textarea>

                                                </div>

                                                <div class="mb-6">
                                                    <label class="form-label" for="chatID">Chat ID</label>
                                                    <input type="text" class="form-control" id="chatID"
                                                        placeholder="Chat ID" name="chatID"
                                                        value="{{ !empty(env('TELEGRAM_CHAT_ID')) ? trim(env('TELEGRAM_CHAT_ID')) : env('TELEGRAM_CHAT_ID') }}"
                                                        aria-label="Notification title">
                                                </div>

                                                <div class="form-password-toggle">
                                                    <label class="form-label" for="botToken">Bot Token</label>
                                                    <div class="input-group input-group-merge">
                                                        <input type="password" class="form-control" id="botToken"
                                                            name="botToken"
                                                            value="{{ !empty(env('TELEGRAM_BOT_TOKEN')) ? trim(env('TELEGRAM_BOT_TOKEN')) : env('TELEGRAM_BOT_TOKEN') }}"
                                                            placeholder="············"
                                                            aria-describedby="basic-default-password">
                                                        <span class="input-group-text cursor-pointer"
                                                            id="basic-default-password"><i class="bx bx-hide"></i></span>
                                                    </div>
                                                </div>


                                                <div class="accordion mt-4" id="accordionExample">
                                                    <div class="card accordion-item">
                                                        <h2 class="accordion-header" id="headingThree">
                                                            <button type="button" class="accordion-button collapsed"
                                                                data-bs-toggle="collapse" data-bs-target="#accordionThree"
                                                                aria-expanded="false" aria-controls="accordionThree">
                                                                Instructions For Use
                                                            </button>
                                                        </h2>
                                                        <div id="accordionThree" class="accordion-collapse collapse"
                                                            aria-labelledby="headingThree"
                                                            data-bs-parent="#accordionExample">
                                                            <div class="accordion-body">
                                                                <div
                                                                    class="ant-space css-14brfei ant-space-vertical ant-space-gap-row-small ant-space-gap-col-small">
                                                                    <div class="ant-space-item py-1"> <span
                                                                            class="ant-typography css-14brfei"> 1. Use <a
                                                                                class="ant-typography css-14brfei"
                                                                                href="https://www.thegioididong.com/game-app/huong-dan-tao-bot-telegram-don-gian-ai-cung-co-the-thuc-hien-1395501"
                                                                                target="_blank" rel="noopener noreferrer">
                                                                                the guide
                                                                                here </a> to create a bot and get the token.
                                                                        </span>
                                                                    </div>
                                                                    <div class="ant-space-item py-1"> <span
                                                                            class="ant-typography css-14brfei"> 2. Create a
                                                                            new
                                                                            Telegram
                                                                            group and add your bot to the group. </span>
                                                                    </div>
                                                                    <div class="ant-space-item py-1"> <span
                                                                            class="ant-typography css-14brfei"> 3. Send a
                                                                            message to
                                                                            the
                                                                            group before proceeding to the next step.
                                                                        </span> </div>
                                                                    <div class="ant-space-item py-1"> <span
                                                                            class="ant-typography css-14brfei"> 4. Once you
                                                                            have the
                                                                            bot
                                                                            token, prepare the URL in the following format:
                                                                            <code>https://api.telegram.org/bot[BOT_TOKEN]/getUpdates</code>.
                                                                        </span> </div>
                                                                    <div class="ant-space-item py-1"> <span
                                                                            class="ant-typography css-14brfei"> 5. Replace
                                                                            [BOT_TOKEN]
                                                                            in the URL with your bot token (replace the
                                                                            entire
                                                                            [BOT_TOKEN] placeholder with your actual bot
                                                                            token). For
                                                                            example, if your bot token is
                                                                            <code>66232322283:AAEadassdasdasdasdasdOOE</code>,
                                                                            the
                                                                            corresponding URL will be
                                                                            <code>https://api.telegram.org/bot66232322283:AAEadassdasdasdasdasdOOE/getUpdates</code>.
                                                                        </span> </div>
                                                                    <div class="ant-space-item py-1"> <span
                                                                            class="ant-typography css-14brfei"> 6. Paste
                                                                            the prepared
                                                                            URL from step 4 into a new browser tab. </span>
                                                                    </div>
                                                                    <div class="ant-space-item py-1"> <span
                                                                            class="ant-typography css-14brfei"> 7. Retrieve
                                                                            the group
                                                                            ID
                                                                            as shown in the image below. Note: Make sure to
                                                                            copy the
                                                                            minus sign (e.g., in the image, the group ID is
                                                                            -1002334314285). </span> </div>
                                                                    <div class="ant-space-item py-1">
                                                                        <div class="ant-image css-14brfei"> <img
                                                                                class="ant-image-img css-14brfei w-100"
                                                                                src="https://feline.doctorx.vn/assets/telegram.png">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="navs-pills-top-profile" role="tabpanel">

                                <div class="row">
                                    <!-- First column-->
                                    <div class="col-12 col-lg-12">
                                        <!-- Notification Information -->
                                        <div class=" mb-6">
                                            {{-- <div class="card-header">
                                                <h5 class="card-title mb-0">Telegram</h5>
                                            </div> --}}
                                            <div class="card-body">
                                                <!-- Description -->
                                                <div class="mb-6">
                                                    <label for="messageContact" class="form-label">Message Template</label>
                                                    <textarea class="form-control" name="messageContact" id="editor" rows="9" placeholder="Message Template">{{ !empty($data['messageContact'])
                                                        ? trim($data['messageContact'])
                                                        : trim(
                                                            "🧑 Customer Name: {CUSTOMER_NAME}
✉️ Subject: {SUBJECT}
💬 Message:

{MESSAGE}

📅 Date Submitted: {DATE_SUBMITTED}",
                                                        ) }}</textarea>

                                                </div>

                                                <div class="mb-6">
                                                    <label class="form-label" for="chatIDContact">Chat ID</label>
                                                    <input type="text" class="form-control" id="chatIDContact"
                                                        placeholder="Chat ID" name="chatIDContact"
                                                        value="{{ !empty(env('TELEGRAM_CHAT_ID_CONTACT')) ? trim(env('TELEGRAM_CHAT_ID_CONTACT')) : env('TELEGRAM_CHAT_ID_CONTACT') }}"
                                                        aria-label="Notification title">
                                                </div>

                                                <div class="form-password-toggle">
                                                    <label class="form-label" for="botTokenContact">Bot Token</label>
                                                    <div class="input-group input-group-merge">
                                                        <input type="password" class="form-control" id="botTokenContact"
                                                            name="botTokenContact"
                                                            value="{{ !empty(env('TELEGRAM_BOT_TOKEN_CONTACT')) ? trim(env('TELEGRAM_BOT_TOKEN_CONTACT')) : env('TELEGRAM_BOT_TOKEN_CONTACT') }}"
                                                            placeholder="············"
                                                            aria-describedby="basic-default-password">
                                                        <span class="input-group-text cursor-pointer"
                                                            id="basic-default-password"><i class="bx bx-hide"></i></span>
                                                    </div>
                                                </div>


                                                <div class="accordion mt-4" id="accordionExample">
                                                    <div class="card accordion-item">
                                                        <h2 class="accordion-header" id="headingThree">
                                                            <button type="button" class="accordion-button collapsed"
                                                                data-bs-toggle="collapse" data-bs-target="#accordionThree"
                                                                aria-expanded="false" aria-controls="accordionThree">
                                                                Instructions For Use
                                                            </button>
                                                        </h2>
                                                        <div id="accordionThree" class="accordion-collapse collapse"
                                                            aria-labelledby="headingThree"
                                                            data-bs-parent="#accordionExample">
                                                            <div class="accordion-body">
                                                                <div
                                                                    class="ant-space css-14brfei ant-space-vertical ant-space-gap-row-small ant-space-gap-col-small">
                                                                    <div class="ant-space-item py-1"> <span
                                                                            class="ant-typography css-14brfei"> 1. Use <a
                                                                                class="ant-typography css-14brfei"
                                                                                href="https://www.thegioididong.com/game-app/huong-dan-tao-bot-telegram-don-gian-ai-cung-co-the-thuc-hien-1395501"
                                                                                target="_blank" rel="noopener noreferrer">
                                                                                the guide
                                                                                here </a> to create a bot and get the token.
                                                                        </span>
                                                                    </div>
                                                                    <div class="ant-space-item py-1"> <span
                                                                            class="ant-typography css-14brfei"> 2. Create a
                                                                            new
                                                                            Telegram
                                                                            group and add your bot to the group. </span>
                                                                    </div>
                                                                    <div class="ant-space-item py-1"> <span
                                                                            class="ant-typography css-14brfei"> 3. Send a
                                                                            message to
                                                                            the
                                                                            group before proceeding to the next step.
                                                                        </span> </div>
                                                                    <div class="ant-space-item py-1"> <span
                                                                            class="ant-typography css-14brfei"> 4. Once you
                                                                            have the
                                                                            bot
                                                                            token, prepare the URL in the following format:
                                                                            <code>https://api.telegram.org/bot[BOT_TOKEN]/getUpdates</code>.
                                                                        </span> </div>
                                                                    <div class="ant-space-item py-1"> <span
                                                                            class="ant-typography css-14brfei"> 5. Replace
                                                                            [BOT_TOKEN]
                                                                            in the URL with your bot token (replace the
                                                                            entire
                                                                            [BOT_TOKEN] placeholder with your actual bot
                                                                            token). For
                                                                            example, if your bot token is
                                                                            <code>66232322283:AAEadassdasdasdasdasdOOE</code>,
                                                                            the
                                                                            corresponding URL will be
                                                                            <code>https://api.telegram.org/bot66232322283:AAEadassdasdasdasdasdOOE/getUpdates</code>.
                                                                        </span> </div>
                                                                    <div class="ant-space-item py-1"> <span
                                                                            class="ant-typography css-14brfei"> 6. Paste
                                                                            the prepared
                                                                            URL from step 4 into a new browser tab. </span>
                                                                    </div>
                                                                    <div class="ant-space-item py-1"> <span
                                                                            class="ant-typography css-14brfei"> 7. Retrieve
                                                                            the group
                                                                            ID
                                                                            as shown in the image below. Note: Make sure to
                                                                            copy the
                                                                            minus sign (e.g., in the image, the group ID is
                                                                            -1002334314285). </span> </div>
                                                                    <div class="ant-space-item py-1">
                                                                        <div class="ant-image css-14brfei"> <img
                                                                                class="ant-image-img css-14brfei w-100"
                                                                                src="https://feline.doctorx.vn/assets/telegram.png">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>


                </form>
            </div>
        </div>
    </div>
@endsection
