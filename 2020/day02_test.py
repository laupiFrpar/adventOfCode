from day02 import *

def test_is_valid():
  assert isValid('1-3 a: abcde') == True
  assert isValid('1-3 b: cdefg') == False
  assert isValid('2-9 c: ccccccccc') == True
  assert isValid('15-17 p: ppppppppppppppsps') == True

def test_build_rule():
  letter, minCount, maxCount = buildRule("1-3 a")
  assert letter == 'a'
  assert minCount == 1
  assert maxCount == 3
  letter, minCount, maxCount =  buildRule("1-3 b")
  assert letter == 'b'
  assert minCount == 1
  assert maxCount == 3
  letter, minCount, maxCount = buildRule("2-9 c")
  assert letter == 'c'
  assert minCount == 2
  assert maxCount == 9
  letter, minCount, maxCount = buildRule('15-17 p')
  assert letter == 'p'
  assert minCount == 15
  assert maxCount == 17

def test_count_valid():
  assert countValid(['1-3 a: abcde', '1-3 b: cdefg', '2-9 c: ccccccccc']) == 2

def test_is_valid_position():
  assert isValidPosition('1-3 a: abcde') == True
  assert isValidPosition('1-3 b: cdefg') == False
  assert isValidPosition('2-9 c: ccccccccc') == False
  assert isValidPosition('15-17 p: ppppppppppppppsps') == False

def test_count_valid_position():
  assert countValidPosition(
      ['1-3 a: abcde', '1-3 b: cdefg', '2-9 c: ccccccccc']) == 1
