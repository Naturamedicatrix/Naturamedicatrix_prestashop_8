/*
 * Svix API
 *
 * No description provided (generated by Openapi Generator https://github.com/openapitools/openapi-generator)
 *
 * API version: 1.1.1
 */

// Code generated by OpenAPI Generator (https://openapi-generator.tech); DO NOT EDIT.

package openapi

import (
	"encoding/json"
)

// CompletionChoice struct for CompletionChoice
type CompletionChoice struct {
	FinishReason string `json:"finish_reason"`
	Index int64 `json:"index"`
	Message CompletionMessage `json:"message"`
}

// NewCompletionChoice instantiates a new CompletionChoice object
// This constructor will assign default values to properties that have it defined,
// and makes sure properties required by API are set, but the set of arguments
// will change when the set of required properties is changed
func NewCompletionChoice(finishReason string, index int64, message CompletionMessage) *CompletionChoice {
	this := CompletionChoice{}
	this.FinishReason = finishReason
	this.Index = index
	this.Message = message
	return &this
}

// NewCompletionChoiceWithDefaults instantiates a new CompletionChoice object
// This constructor will only assign default values to properties that have it defined,
// but it doesn't guarantee that properties required by API are set
func NewCompletionChoiceWithDefaults() *CompletionChoice {
	this := CompletionChoice{}
	return &this
}

// GetFinishReason returns the FinishReason field value
func (o *CompletionChoice) GetFinishReason() string {
	if o == nil {
		var ret string
		return ret
	}

	return o.FinishReason
}

// GetFinishReasonOk returns a tuple with the FinishReason field value
// and a boolean to check if the value has been set.
func (o *CompletionChoice) GetFinishReasonOk() (*string, bool) {
	if o == nil  {
		return nil, false
	}
	return &o.FinishReason, true
}

// SetFinishReason sets field value
func (o *CompletionChoice) SetFinishReason(v string) {
	o.FinishReason = v
}

// GetIndex returns the Index field value
func (o *CompletionChoice) GetIndex() int64 {
	if o == nil {
		var ret int64
		return ret
	}

	return o.Index
}

// GetIndexOk returns a tuple with the Index field value
// and a boolean to check if the value has been set.
func (o *CompletionChoice) GetIndexOk() (*int64, bool) {
	if o == nil  {
		return nil, false
	}
	return &o.Index, true
}

// SetIndex sets field value
func (o *CompletionChoice) SetIndex(v int64) {
	o.Index = v
}

// GetMessage returns the Message field value
func (o *CompletionChoice) GetMessage() CompletionMessage {
	if o == nil {
		var ret CompletionMessage
		return ret
	}

	return o.Message
}

// GetMessageOk returns a tuple with the Message field value
// and a boolean to check if the value has been set.
func (o *CompletionChoice) GetMessageOk() (*CompletionMessage, bool) {
	if o == nil  {
		return nil, false
	}
	return &o.Message, true
}

// SetMessage sets field value
func (o *CompletionChoice) SetMessage(v CompletionMessage) {
	o.Message = v
}

func (o CompletionChoice) MarshalJSON() ([]byte, error) {
	toSerialize := map[string]interface{}{}
	if true {
		toSerialize["finish_reason"] = o.FinishReason
	}
	if true {
		toSerialize["index"] = o.Index
	}
	if true {
		toSerialize["message"] = o.Message
	}
	return json.Marshal(toSerialize)
}

type NullableCompletionChoice struct {
	value *CompletionChoice
	isSet bool
}

func (v NullableCompletionChoice) Get() *CompletionChoice {
	return v.value
}

func (v *NullableCompletionChoice) Set(val *CompletionChoice) {
	v.value = val
	v.isSet = true
}

func (v NullableCompletionChoice) IsSet() bool {
	return v.isSet
}

func (v *NullableCompletionChoice) Unset() {
	v.value = nil
	v.isSet = false
}

func NewNullableCompletionChoice(val *CompletionChoice) *NullableCompletionChoice {
	return &NullableCompletionChoice{value: val, isSet: true}
}

func (v NullableCompletionChoice) MarshalJSON() ([]byte, error) {
	return json.Marshal(v.value)
}

func (v *NullableCompletionChoice) UnmarshalJSON(src []byte) error {
	v.isSet = true
	return json.Unmarshal(src, &v.value)
}


