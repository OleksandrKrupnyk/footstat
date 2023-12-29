<?php
/** @var \Illuminate\Database\Eloquent\Collection $marks */
?>
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('User Club') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    Favorite Club: {{$club->title ?? ''}}<br/>
                    Opponent Club: {{$opponent->title ?? ''}}<br/>
                    <table class="min-w-full text-left text-sm font-light">
                        <thead class="border-b font-medium dark:border-neutral-500">
                        <tr>
                            <th scope="col" class="px-6 py-4 text-center">Criteria</th>
                            <th scope="col" class="px-6 py-4 text-center">
                                <x-bladewind::icon name="bars-arrow-down" class="inline h-16 w-16 text-red-500"/>
                                <br/>Low Mark
                            </th>
                            <th scope="col" class="px-6 py-4 text-center">
                                <x-bladewind::icon name="receipt-percent" class="inline h-16 w-16 text-amber-500"/>
                                <br/>Avg Mark
                            </th>
                            <th scope="col" class="px-6 py-4 text-center">
                                <x-bladewind::icon name="bars-arrow-up" class="inline h-16 w-16 text-green-500"/>
                                <br/>Hi Mark
                            </th>
                            <th scope="col" class="px-6 py-4 text-center">
                                <x-bladewind::icon name="hashtag" class="inline h-16 w-16 text-amber-500"/>
                                <br/>Count
                            </th>
                            <th scope="col" class="px-6 py-4 text-center">
                                <x-bladewind::icon name="trophy" class="inline h-16 w-16 text-blue-500"/>
                                <br/>
                                Max Scale
                            </th>
                            <th scope="col" class="px-6 py-4 text-center">
                                <x-bladewind::icon name="hand-thumb-up" class="inline h-16 w-16 text-amber-500"/>
                                <br/>
                                Last Mark
                            </th>
                            <th scope="col" class="px-6 py-4 text-center">
                                <x-bladewind::icon name="calendar-days" class="inline h-16 w-16"/>
                                <br/>Last Vote
                            </th>
                            <th scope="col" class="px-6 py-4 text-center">
                                Action
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($criterions as $criteria)

                            <tr class="border-b dark:border-neutral-500">
                                <td class="px-6 py-4">
                                                                        {{$criteria->criterion->title}}<hr/>
                                    <x-start-rating
                                        id="read_{{$criteria->id}}"
                                        name="star-rating"
                                        readonly="true"
                                        size="normal"
                                        :value="number_format($comMarks[$criteria->id]->avg * 5/ $maxMarks[$criteria->id])"
                                    />
                                </td>
                                <td class="px-6 py-4 align-middle text-center">
                                    <span class="text-red-400 font-bold">{{$comMarks[$criteria->id]->low ??'0'}}</span>
                                </td>
                                <td class="px-6 py-4 align-middle text-center">
                                    {{   number_format($comMarks[$criteria->id]->avg,2) ??'0'}}
                                    <hr/>
                                    ({{  number_format($comMarks[$criteria->id]->avg * 100/ $maxMarks[$criteria->id],2) }}
                                    %)
                                </td>
                                <td class="px-6 py-4 align-middle text-center">
                                    <span class="text-green-500 font-bold">
                                    {{$comMarks[$criteria->id]->hi??'0'}}
                                    </span>
                                </td>
                                <td class="px-6 py-4 align-middle text-center">
                                    {{$comMarks[$criteria->id]->count??'0'}}
                                </td>
                                <td class="px-6 py-4 align-middle text-center">
                                    <span class="font-bold text-blue-500">
                                    {{$maxMarks[$criteria->id]??'0'}}
                                    </span>
                                </td>
                                <td class="px-6 py-4 align-middle text-center">
                                    {{$marks[$criteria->id]->mark_value??''}}
                                </td>
                                <td class="px-6 py-4 align-middle text-center">
                                    {{$marks[$criteria->id]->updated_at??''}}

                                </td>
                                <td class="px-6 py-4 align-middle text-center">
                                    <x-bladewind::button
                                        size="tiny"
                                        :onclick="'showModal(`setRating'.$criteria->id.'`)'">
                                        Vote
                                    </x-bladewind::button>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    @foreach($criterions as $criteria)
        <x-bladewind::modal
            backdrop_can_close="false"
            size="small"
            :name="'setRating'.$criteria->id"
            title="{{$criteria->criterion->title}}"
            ok_button_action="voteEmblem(`form{{$criteria->id}}`)"
            ok_button_label="Vote"
            close_after_action="false"
            center_action_buttons="true">
            <form method="post"
                  action="{{route('vote.emblem')}}"
                  name="form{{$criteria->id}}"
                  id="form{{$criteria->id}}"
                  class="vote-form"
            >
                @csrf
                <x-bladewind::input hidden="true" name="criteria_id" :value="$criteria->id"/>
                <x-bladewind::input hidden="true" name="user_id" :value="$user->id"/>
                <x-start-rating
                    id="mark_value{{$criteria->id}}"
                    max-value="{{$criteria->criterion->scale->max_value}}"
                    name="mark_value"
                    size="normal"
                />

            </form>
        </x-bladewind::modal>
    @endforeach
    <script>
        (function () {
        }(
            voteEmblem = function (formid) {
                if (validateForm('#' + formid)) {
                    domEl('#' + formid).submit();
                } else {
                    return false;
                }
            }
        ));
    </script>
</x-app-layout>
