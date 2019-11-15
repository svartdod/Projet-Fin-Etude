/* global $, QUnit, swal */

const simulateMouseEvent = (x, y, eventType) => {
  var event = $.Event(eventType)
  event.clientX = x
  event.clientY = y
  $(document.elementFromPoint(x, y)).trigger(event)
}

QUnit.test('overlay click', (assert) => {
  const done = assert.async()

  swal({
    title: 'Overlay click'
  }).then((result) => {
    assert.deepEqual(result, {dismiss: 'overlay'})
    done()
  })

  $('.swal2-container').click()
})

QUnit.test('popup mousedown, overlay mouseup', (assert) => {
  const done = assert.async()

  swal({
    title: 'popup mousedown, overlay mouseup'
  })

  simulateMouseEvent(1, 1, 'mousedown')
  simulateMouseEvent(window.innerWidth / 2, window.innerHeight / 2, 'mouseup')

  setTimeout(() => {
    assert.ok(swal.isVisible())
    done()
  }, 300)
})

QUnit.test('overlay mousedown, popup mouseup', (assert) => {
  const done = assert.async()

  swal({
    title: 'overlay mousedown, popup mouseup'
  })

  simulateMouseEvent(window.innerWidth / 2, window.innerHeight / 2, 'mousedown')
  simulateMouseEvent(1, 1, 'mouseup')

  setTimeout(() => {
    assert.ok(swal.isVisible())
    done()
  }, 300)
})

QUnit.test('allowOutsideClick: false', (assert) => {
  const done = assert.async()

  swal({
    title: 'allowOutsideClick: false',
    allowOutsideClick: false
  })

  $('.swal2-container').click()

  setTimeout(() => {
    assert.ok(swal.isVisible())
    done()
  }, 300)
})

QUnit.test('allowOutsideClick: () => !swal.isLoading()', (assert) => {
  const done = assert.async()

  swal({
    title: 'allowOutsideClick: () => !swal.isLoading()',
    allowOutsideClick: () => !swal.isLoading()
  }).then((result) => {
    assert.deepEqual(result, {dismiss: 'overlay'})
    done()
  })

  swal.showLoading()

  $('.swal2-container').click()

  setTimeout(() => {
    assert.ok(swal.isVisible())
    swal.hideLoading()
    $('.swal2-container').click()
  }, 300)
})
