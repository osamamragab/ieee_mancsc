for _ in range(int(input())):
    pos = input() # CN
    out = [c+pos[1] for c in "abcdefgh" if c != pos[0]]
    out.extend([pos[0]+n for n in "12345678" if n != pos[1]])
    print(*out, sep="\n")
